<?php

namespace Application\Model;

class Application
{
    protected $servicelocator;

    public function setServiceLocator(\Zend\ServiceManager\ServiceManager $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

    public function getTitle()
    {
        $config = $this->getServiceLocator()->get('Config');

        return 'Hello world !';
    }

}
