<?php
namespace Leads\V2\Rest\ContactActions;

require_once (APPL_PATH . 'COMMON/classes/Contact.class.php');
require_once (APPL_PATH .'welcome/classes/actionsContact.class.php');
require_once (APPL_PATH .'welcome/classes/calendar.php');
require_once (APPL_PATH .'welcome/classes/crmCore.class.php');
require_once (APPL_PATH .'welcome/classes/feedback.class.php');


class ContactActionsMapper
{
    public function __construct(Array $config = array())
    {
        $this->config = $config;
    }
    
    public function createCrmAction($data,$token)
    {
    	
    	
        $result = true;
        $error = '';
        try {
            $actionType = \ActionsContact::findActionTypesByPk(
                $data->CODENAME, 
                $token['CODLANGUAGE']
            );
			
           var_dump($actionType);
            
            if (!isset($actionType[0])) {
                throw new \Exception ('No action defined');
            }
            
            
            $output =  \Calendar_Model::findUserCalendars($token['LOGINNAME']);
            
            if($output[0]['SUMMARY'] =='default')
           		$calendar_id = $output[0]['ID']? $output[0]['ID']:'0';
           
            
            $codevent = \Calendar_Model::createEvent (
                $calendar_id,
                date ("Y-m-d H:i:s", $data->DATE_START),
                $data->DATE_END,
                0,
                "{$actionType[0]['NAMEACTION']}: {$data->LASTNAME}",
                0,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                $data->NOTES,
                'opaque',
                'default',
                null,
                $data->LASTNAME,
                1);
                
            if (!$codevent) {
                throw new \Exception ('No event created');
            }$actionType = \ActionsContact::findActionTypesByPk(
                $data->CODENAME, 
                $token['CODLANGUAGE']
            );
         
        	

            if (!isset($actionType[0])) {
                throw new \Exception ('No action defined');
            }
            
         
            $codevent = \Calendar_Model::createEvent (
                $codevent,
                date ("Y-m-d H:i:s", $data->DATE_START),
                $data->DATE_END,
                0,
                "{$actionType[0]['NAMEACTION']}: {$data->LASTNAME}",
                0,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                $data->NOTES,
                'opaque',
                'default',
                null,
                $data->LASTNAME,
                1);
                
            if (!$codevent) {
                throw new \Exception ('No event created');
            }
            
            
            $codcontact =  \ActionsContact::findLastActionsOnContacts($token['LOGINNAME'], $token['CODLANGUAGE']);
            
             
            $output = \CrmCore::crmUpgradeStatus (
            		$token['CODMARKET'],
            		$token['CODDEALER'],
            		$token['LOGINNAME'],
            		$actionType[0]['CODACTION'],
            		$codcontact[0]['CODCONTACT'],
            		null,
            		null,
            		null,
            		null,
            		null,
            		null,
            		$data->NOTES,
            		null,
            		null,
            		$codevent,
            		null,
            		null,
            		null,
            		$data->CODBRAND);
            
             
            if (!$output) {
            	throw new \Exception ('No event created');
            }
        } catch (\Exception $e) {
        
            $result = false;
            $error = $e->getMessage();
        }
        return new ContactActionsEntity(
            array(
                'result' => $result,
                'event_id' => $codevent,
                'error' => $error
            )
        );
    }
}