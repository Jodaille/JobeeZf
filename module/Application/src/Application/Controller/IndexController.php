<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Application;

class IndexController extends AbstractActionController
{
    protected $_application;
    protected $_read_file;

    public function __construct(Application $application = null, $ReadFile = null)
    {
        if (!is_null($application)) {
            $this->_application = $application;
        }
        if (!is_null($ReadFile)) {
            $this->_read_file = $ReadFile;
        }
    }

    public function indexAction()
    {
        $view = new ViewModel();
        $view->AppTitle = null;
        if($this->_application)
        {
            $view->AppTitle = $this->_application->getTitle();
        }
        return $view;
    }

    public function readlogAction()
    {
        $request    = $this->getRequest();
        $filename   = $request->getParam('filename');

        $view = new ViewModel();

        $this->_read_file->parseLog($filename);

        return $view;
    }
}
