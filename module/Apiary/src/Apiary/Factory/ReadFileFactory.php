<?php

namespace Apiary\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReadFileFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \Apiary\Model\ReadFile();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
