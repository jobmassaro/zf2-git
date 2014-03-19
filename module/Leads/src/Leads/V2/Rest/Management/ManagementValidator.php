<?php
namespace Leads\V2\Rest\Management;
require_once (APPL_PATH.'COMMON/classes/InternalTokens.class.php');

use Zend\InputFilter\InputFilter;

class ManagementValidator extends InputFilter
{
    public function init()
    {
        $this->add(
            array(
                'name' => 'Udid',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'alnum', 
                        'options' => array(
                            'breakchainonfailure' => true
                        ),
                    ),
                    array(
                        'name' => 'stringlength', 
                        'options' => array(
                            'min' => 40, 
                            'max' => 40,
                            'breakchainonfailure' => true
                        ),
                    ),
                )
            )
        );
        
        $this->add(
            array(
                'name' => 'Token',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'alnum', 
                        'options' => array(
                            'breakchainonfailure' => true
                        ),
                    ),
                    array(
                        'name' => 'stringlength', 
                        'options' => array(
                            'min' => 64, 
                            'max' => 64,
                            'breakchainonfailure' => true
                        ),
                    ),
                    array(
                        'name' => 'callback', 
                        'options'  => array(
                            'callback' => function ($value, $context) {
                            
                                $rset = \InternalTokens::findbyprimarykey ($value, $context['Udid']);   
                                return isset($rset[0]) || false;
                            },
                            'breakchainonfailure' => true 
                        )
                    )
                )
            )
        );
    }
}
