<?php
namespace Apiary;


return array(
    'router' => array(
        'routes' => include __DIR__ . '/http.routes.config.php',
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => include __DIR__ . '/console.routes.config.php',
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator'    => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Apiary'      => 'Apiary\Factory\ApiaryFactory',
            'ReadFile'      => 'Apiary\Factory\ReadFileFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            //'Apiary\Controller\Index' => Controller\IndexController::class
        ),
        'factories' => array(
            'Apiary\Controller\Index'  => 'Apiary\Controller\Factory\IndexControllerFactory',
        )
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),

    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
