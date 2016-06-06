<?php
// IndexControllerFactory.php
namespace Application\Controller\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\Exception\ServiceNotCreatedException,
    Application\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $sm = $serviceLocator->getServiceLocator();

        $application = $sm->get('MyApplication');
        $ReadFile    = $sm->get('ReadFile');


        $controller = new IndexController($application, $ReadFile);

        return $controller;
    }
}
