<?php
// $Id: module.config.php,v 1.6 2014/03/19 14:21:12 fiorentino Exp $
return array(
    'zf-rest' => array(
        'Leads\\V2\\Rest\\Management\\Controller' => array(
            'listener'                => 'Leads\V2\Rest\Management\ManagementResource',
            'collection_name'         => 'lead-assign',
            'page_size'               => '10',
            'route_name'              => 'leads.rest.management',
            'resource_http_methods'   => array('GET', 'PATCH','POST'),
            'collection_http_methods' => array('GET', 'POST'),
            'entity_class'            => 'Leads\V2\Rest\Management\ManagementEntity',
            'collection_class'        => 'Leads\V2\Rest\Management\ManagementCollection',
        ),
        'Leads\\V2\\Rest\\ContactActions\\Controller' => array(
            'listener'                => 'Leads\V2\Rest\ContactActions\ContactActionsResource',
            'collection_name'         => 'contact-actions',
            'page_size'               => '10',
            'route_name'              => 'leads.rest.contactactions',
            'resource_http_methods'   => array('GET', 'PATCH', 'POST'),
            'collection_http_methods' => array('GET', 'POST'),
            'entity_class'            => 'Leads\V2\Rest\ContactActions\ContactActionsEntity',
            'collection_class'        => 'Leads\V2\Rest\ContactActions\ContactActionsCollection',
        ),
        'Leads\\V2\\Rest\\Feedback\\Controller' => array(
            'listener'                => 'Leads\V2\Rest\Feedback\FeedbackResource',
            'collection_name'         => 'feedbacks',
            'page_size'               => '10',
            'route_name'              => 'leads.rest.feedback',
            'resource_http_methods'   => array('POST'),
            'collection_http_methods' => array('POST'),
            'entity_class'            => 'Leads\V2\Rest\Feedback\FeedbackEntity',
            'collection_class'        => 'Leads\V2\Rest\Feedback\FeedbackCollection',
        ),
        'Leads\\V2\\Rest\\Languages\\Controller' => array(
            'listener'                => 'Leads\V2\Rest\Languages\LanguagesResource',
            'collection_name'         => 'translations',
            'page_size'               => '10',
            'route_identifier_name'   => 'login_name',
            'route_name'              => 'leads.rest.translation',
            'resource_http_methods'   => array('GET'),
            'collection_http_methods' => array('GET'),
            'entity_class'            => 'Leads\V2\Rest\Languages\LanguagesEntity',
            'collection_class'        => 'Leads\V2\Rest\Languages\LanguagesCollection',
        ),
        'Leads\\V2\\Rest\\Template\\Controller' => array(
            'listener'                => 'Leads\V2\Rest\Template\TemplateResource',
            'collection_name'         => 'languagess',
            'page_size'               => '10',
            'route_identifier_name'   => 'market_id',
            'route_name'              => 'leads.rest.languages',
            'resource_http_methods'   => array('GET'),
            'collection_http_methods' => array('GET'),
            'entity_class'            => 'Leads\V2\Rest\Template\TemplateEntity',
            'collection_class'        => 'Leads\V2\Rest\Template\TemplateCollection',
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Leads\\V2\\Rest\\Management\\ManagementEntity' => array(
                'identifier_name' => 'management_id',
                'route_name' => 'leads.rest.management',
                'hydrator' => 'arrayserializable',
            ),
            'Leads\\V2\\Rest\\Management\\ManagementCollection' => array(
                'identifier_name' => 'management_id',
                'route_name' => 'leads.rest.management',
                'is_collection' => '1',
            ),
            'Leads\\V2\\Rest\\ContactActions\\ContactActionsEntity' => array(
                'identifier_name' => 'event_id',
                'route_name' => 'leads.rest.contactactions',
                'hydrator' => 'arrayserializable',
            ),
            'Leads\\V2\\Rest\\ContactActions\\ContactActionsCollection' => array(
                'identifier_name' => 'event_id',
                'route_name' => 'leads.rest.contactactions',
                'is_collection' => true,
            ),
            'Leads\\V2\\Rest\\Feedback\\FeedbackEntity' => array(
                'identifier_name' => 'feedback_id',
                'route_name' => 'leads.rest.feedback',
                'hydrator' => 'arrayserializable',
            ),
            'Leads\\V2\\Rest\\Feedback\\FeedbackCollection' => array(
                'identifier_name' => 'feedback_id',
                'route_name' => 'leads.rest.feedback',
                'is_collection' => true,
            ),
            'Leads\\V2\\Rest\\Languages\\LanguagesEntity' => array(
                'identifier_name' => 'login_name',
                'route_name' => 'leads.rest.translation',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'Leads\\V2\\Rest\\Languages\\LanguagesCollection' => array(
                'identifier_name' => 'login_name',
                'route_name' => 'leads.rest.translation',
                'is_collection' => true,
            ),
            'Leads\\V2\\Rest\\Template\\TemplateEntity' => array(
                'identifier_name' => 'market_id',
                'route_name' => 'leads.rest.languages',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ClassMethods',
            ),
            'Leads\\V2\\Rest\\Template\\TemplateCollection' => array(
                'identifier_name' => 'market_id',
                'route_name' => 'leads.rest.languages',
                'is_collection' => true,
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'leads.rest.management' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/leads/management[/:management_id]',
                    'defaults' => array(
                        'controller' => 'Leads\\V2\\Rest\\Management\\Controller',
                    ),
                ),
            ),
            'leads.rest.contactactions' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/leads/contactactions[/:event_id]',
                    'defaults' => array(
                        'controller' => 'Leads\\V2\\Rest\\ContactActions\\Controller',
                    ),
                ),
            ),
            'leads.rest.feedback' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/leads/feedback[/:feedback_id]',
                    'defaults' => array(
                        'controller' => 'Leads\\V2\\Rest\\Feedback\\Controller',
                    ),
                ),
            ),
            'leads.rest.translation' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/leads/translation[/:login_name]',
                    'defaults' => array(
                        'controller' => 'Leads\\V2\\Rest\\Languages\\Controller',
                    ),
                ),
            ),
            'leads.rest.languages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/leads/languages[/:market_id]',
                    'defaults' => array(
                        'controller' => 'Leads\\V2\\Rest\\Template\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'leads.rest.management',
        ),
        'default_version' => 2,
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(),
    ),
);
