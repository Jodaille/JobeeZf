<?php
/**
* Console routes configuration
*
*/
return
    array(
        'readlog' => array(
            'options' => array(
                'route' => 'readlog [<filename>]',
                'defaults' => array(
                    'controller' => 'Apiary\Controller\Index',
                    'action' => 'readlog'
                    )
                )
        ),
        'readcsv' => array(
            'options' => array(
                'route' => 'readcsv [<filename>]',
                'defaults' => array(
                    'controller' => 'Apiary\Controller\Index',
                    'action' => 'readcsv'
                    )
                )
        ),

        'gethivedatas' => array(
            'options' => array(
                'route' => 'gethivedatas',
                'defaults' => array(
                    'controller' => 'Apiary\Controller\Index',
                    'action' => 'index'
                )
            )
        ),
    );
