<?php

namespace Apiary\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiaryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {

        $model = new \Apiary\Model\Apiary();
        $model->setServiceLocator($serviceLocator);
        return $model;
    }
}
