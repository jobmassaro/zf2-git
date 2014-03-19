<?php
namespace Auth\V2\Validator;

use Zend\Validator\AbstractValidator;

class MyUser extends AbstractValidator
{
    const EXPIRED = 'expired';
    const ROLE = 'role';   
    const GENERIC = 'generic';     

    protected $url;
    
    protected $messageTemplates = array(
        self::EXPIRED => "Error: Ticket Expired",
        self::ROLE => "Error: No role defined",
        self::GENERIC => "Error: Unable to authenticate user due MyUser techincal problem",
    );

    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    public function isValid($ticket)
    {
        $this->setValue($ticket);
        $isValid = true;

        try {
            $serv_attr_parameters = array ('strAuthTicket' => urldecode($ticket) );
            $userInfoUrl =  $this->url . '/getLinkProfilesByTicket?';        
            $userXml = new \SimpleXMLElement ( $userInfoUrl . http_build_query ( $serv_attr_parameters ), null, true );

            if(!empty($userXml)) {
            
                if (isset ($userXml->attributes()->error[0]) && $userXml->attributes()->error[0] != "") {

                    throw new \Exception(self::EXPIRED);
                }
                
                if (!isset($userXml->attributes()->error[0]) && !$userXml->USER[0]->APPLICATIONS->APPLICATION) {

                    throw new \Exception(self::ROLE);
                }      
                
            } else {
            
                throw new \Exception(self::GENERIC);
            }
        } catch (\Exception $e) {
        
            $this->error($e->getMessage());
            $isValid = false;
        }
        return $isValid;
    }
}