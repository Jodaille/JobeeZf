<?php
return
    array(
    'generateScript' => array(
        'options' => array(
            'route' => 'readlog [<filename>]',
            'defaults' => array(
                'controller' => 'Application\Controller\Index',
                'action' => 'readlog'
                )
            )
        ),
        'gethivedatas' => array(
            'options' => array(
                'route' => 'gethivedatas',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'index'
                )
            )
        ),
    );
