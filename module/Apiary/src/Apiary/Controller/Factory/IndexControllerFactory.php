<?php
// IndexControllerFactory.php
namespace Apiary\Controller\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\Exception\ServiceNotCreatedException,
    Apiary\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $sm = $serviceLocator->getServiceLocator();

        $application = $sm->get('Apiary');
        $ReadFile    = $sm->get('ReadFile');


        $controller = new IndexController($application, $ReadFile);

        return $controller;
    }
}
