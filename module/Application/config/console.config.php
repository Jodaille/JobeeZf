<?php

return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                // Console routes go here
                'readserial' => array(
                    'options' => array(
                        'route' => 'readserial [<port>]',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Index',
                            'action' => 'readserial'
                        )
                    )
                ),
            ),
        ),
    ),
);
