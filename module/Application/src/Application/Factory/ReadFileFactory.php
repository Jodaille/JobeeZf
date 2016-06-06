<?php

namespace Application\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReadFileFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \Application\Model\ReadFile();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
