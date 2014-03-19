<?php
// $Id: module.config.php,v 1.1 2014/03/10 14:44:11 fiorentino Exp $
return array(

    'service_manager' => array(
        'factories' => array(
            'Auth\\V2\\Rest\\Login\\LoginResource' => 'Auth\\V2\\Rest\\Login\\LoginResourceFactory'
        ),
    ),
    'token' => array(
        'hash_type' => 'sha256',
        'key' => 'mySecretKey'
    ),
    'zf-rest' => array(
        'Auth\\V2\\Rest\\Login\\Controller' => array(
            'listener' => 'Auth\\V2\\Rest\\Login\\LoginResource',
            'collection_name' => 'token',
            'page_size' => '1',
            'route_name' => 'auth.rest.login',
            'resource_http_methods' => array(
                0 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'POST',
            ),
            'entity_class' => 'Auth\\V2\\Rest\\Login\\LoginEntity',
            'collection_class' => 'Auth\\V2\\Rest\\Login\\LoginCollection',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Auth\\V2\\Rest\\Login\\LoginEntity' => array(
                'identifier_name' => 'token',
                'route_name' => 'auth.rest.login',
                'hydrator' => 'arrayserializable',
            ),
            'Auth\\V2\\Rest\\Login\\LoginCollection' => array(
                'identifier_name' => 'token',
                'route_name' => 'auth.rest.login',
                'is_collection' => true,
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'auth.rest.login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/auth/login',
                    'defaults' => array(
                        'controller' => 'Auth\\V2\\Rest\\Login\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'auth.rest.login',
        ),
        'default_version' => 2,
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(),
    ),
    'zf-content-validation' => array( 
        'Auth\\V2\\Rest\\Login\\Controller' => array( 
            'input_filter' => 'Auth\\V2\\Rest\\Login\\Validator', 
        ), 
    ),
    'validators' => array (
        'invokables' => array(
            'myuser'     => 'Auth\V2\Validator\MyUser',
        )
    ),
    'input_filters' => array(
        'Auth\\V2\\Rest\\Login\\Validator' => array(
            0 => array(
                'name' => 'Udid',
                'required' => true, 
                'validators' => array(
                    0 => array(
                        'name' => 'alnum',
                        'options' => array( 
                            'breakchainonfailure' => true
                        ),
                    ),
                    1 => array(
                        'name' => 'stringlength',
                        'options' => array(
                            'min' => 40, 
                            'max' => 40,
                            'breakchainonfailure' => true
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'Ticket',
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'myuser',
                        'options' => array(
                            'url' => 'http://upsservice.fiat.com/UPS.asmx',
                            'breakchainonfailure' => true
                        ),
                    ),
                ),
            ),
        ),
    ),
);
