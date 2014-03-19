<?php
namespace Auth;
// $Id: Module.php,v 1.6 2014/03/17 08:34:54 fiorentino Exp $
use ZF\Apigility\ApigilityModuleInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;
use Auth\V2\Validator\Token;
use ZF\ApiProblem\ApiProblem;

require_once (APPL_PATH.'COMMON/classes/InternalTokens.class.php');

class Module implements ApigilityModuleInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
    
    public function onBootStrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_ROUTE, array($this, 'checkToken'));
        /**$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR,  function($e) {
            exit('NOT FOUND');
        });*/
    }
    
    public function checkToken(MvcEvent $e)
    {
        $app = $e->getTarget();
        $services = $app->getServiceManager();
        $match = $e->getRouteMatch();
        if(!$match) {

            return;
        }

        $controller = $match->getParam('controller');
        $namespace = __NAMESPACE__;
        if (preg_match("#^$namespace#", $controller)) {
        
            return;
        }

        $request = $services->get('Request'); 
        $headers = $request->getHeaders(); 
        $inputToCheck = $headers->toArray();
        
        $inputFilter = new Token();
        $inputFilter->init();
        $inputFilter->setData($inputToCheck);
        
        try {
        
            if (!$inputFilter->isValid()) {
            
                throw new \Exception('Invalid data input');
            }
            $tokenProperties = \InternalTokens::findbyprimarykey (
                $inputToCheck['Token'], 
                $inputToCheck['Udid']
            ); 
            if (!isset($tokenProperties[0])) {
            
                throw new \Exception('Invalid Udid/Token');
            }
            
        } catch (\Exception $except) {
        
            $problem  = new ApiProblem(422, $except->getMessage());
            $listener = function ($event) use ($problem) {
                $event->setParam('api-problem', $problem);
                return $problem;
            };
            $e->getApplication()->getEventManager()->attach('dispatch', $listener, 100);
            return;
        }
        $config   = $services->get('Config');
        $config   = $config['zf-rest'][$controller];
        $services->setService($config['listener'], new $config['listener'](new \ArrayObject($tokenProperties[0]))
        );
        return;
    }
} 
