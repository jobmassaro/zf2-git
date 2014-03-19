<?php
namespace Auth\V2\Rest\Login;
require_once (APPL_PATH.'COMMON/classes/InternalTokens.class.php');

class LoginMapper
{
    private $config;
    private $url = 'http://upsservice.fiat.com/UPS.asmx';
    private $defaultAppl = 'IT.LINK';

    public function __construct($config)
    {
        $this->config = $config;
    }
    
    public function create($data)
    {
        $serv_attr_parameters = array ('strAuthTicket' => urldecode($data->Ticket) );
        $userInfoUrl =  $this->url . '/getLinkProfilesByTicket?';        
        $userXml = new \SimpleXMLElement ( $userInfoUrl . http_build_query ( $serv_attr_parameters ), null, true );
        $username = (string)$userXml->USER->USERNAME;
        
        foreach ($userXml->USER->APPLICATIONS->APPLICATION as $appl) {
        
            if ((string)$appl->attributes()->name == $this->defaultAppl){
                $rolecode = (string)$appl->ROLE;
                break;
            }
        }
        return new LoginEntity(
            array(
            'token' => \InternalTokens::store (
                    $this->config, 
                    $data->Udid, 
                    $username, 
                    $rolecode, 
                    $this->defaultAppl
                )
            )
        );
    }
}