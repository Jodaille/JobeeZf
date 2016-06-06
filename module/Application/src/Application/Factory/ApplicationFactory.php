<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApplicationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \Application\Model\Application();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
