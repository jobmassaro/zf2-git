<?php
namespace Leads\V2\Rest\Feedback;
require_once (APPL_PATH .'welcome/classes/actionsContact.class.php');
require_once (APPL_PATH .'welcome/classes/calendar.php');
require_once (APPL_PATH .'welcome/classes/crmCore.class.php');
require_once (APPL_PATH .'welcome/classes/actionsContact.class.php');
require_once (APPL_PATH .'welcome/classes/feedback.class.php');

class FeedbackMapper
{
    public function __construct(Array $config = array())
    {
        $this->config = $config;
    }
    
    public function insertFeedback($data, $token)
    {
    	$result = true;
    	$error = '';

     try{
    	
    		
    		$codcontact =  \ActionsContact::findLastActionsOnContacts($token['LOGINNAME'],$data->CODLANGUAGE);
    		
    		$feedback = \Feedback::createCustomerFeedback (
    				$token['CODMARKET'],
    				$token['LOGINNAME'],
    				$codcontact[0]['CODCONTACT'],
    				$token['LOGINNAME'],
    				$data->NOTES);
    		
    		
    		//	var_dump($feedback);
    		
    		
    		if (!$feedback && !$codcontact) {
    			throw new \Exception ('No event created');
    		}
    		
    		
    		
    		
    	} catch (\Exception $e) {
           	
           	$result = false;
           	$error = $e->getMessage();
           	}
    	
    	
        return new FeedbackEntity(
            array(
                'result' => true,
                'feedback_id' => true
            )
        );
    }
}
