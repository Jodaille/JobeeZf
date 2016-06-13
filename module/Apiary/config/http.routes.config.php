<?php
/**
* Console routes configuration
*
*/
return
array(
    'home' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
            'route'    => '/',
            'defaults' => array(
                'controller' => 'Apiary\Controller\Index',
                'action'     => 'index',
            ),
        ),
    ),
    'graphvoltage' => array(
        'type'    => 'Literal',
        'options' => array(
            'route'    => '/voltage',
            'defaults' => array(
                '__NAMESPACE__' => 'Apiary\Controller',
                'controller'    => 'Index',
                'action'        => 'voltage',
            ),
        ),
    ),
    'hivevoltage' => array(
        'type'    => 'Literal',
        'options' => array(
            'route'    => '/hivevoltage',
            'defaults' => array(
                '__NAMESPACE__' => 'Apiary\Controller',
                'controller'    => 'Index',
                'action'        => 'getHiveVoltage',
            ),
        ),
    ),
    'graphtemperatures' => array(
        'type'    => 'Literal',
        'options' => array(
            'route'    => '/temperature',
            'defaults' => array(
                '__NAMESPACE__' => 'Apiary\Controller',
                'controller'    => 'Index',
                'action'        => 'temperature',
            ),
        ),
    ),
    'hivetemperature' => array(
        'type'    => 'Segment',
        'options' => array(
            'route'    => '/hivetemperature[/][:hivename]',
            'defaults' => array(
                '__NAMESPACE__' => 'Apiary\Controller',
                'controller'    => 'Index',
                'action'        => 'getHiveTemperatures',
            ),
        ),
    ),

    //getHiveSensors
    'hivesensors' => array(
        'type'    => 'Literal',
        'options' => array(
            'route'    => '/hivesensors',
            'defaults' => array(
                '__NAMESPACE__' => 'Apiary\Controller',
                'controller'    => 'Index',
                'action'        => 'getHiveSensors',
            ),
        ),
    ),
);
