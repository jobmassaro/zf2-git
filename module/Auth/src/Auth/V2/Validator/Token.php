<?php
namespace Auth\V2\Validator;

use Zend\InputFilter\InputFilter;

class Token extends InputFilter
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
                    )
                )
            )
        );
    }
}
