<?php

namespace My\Component\Exampleform\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController {
    
    public function display($cachable = false, $urlparams = array())
    {
        $model = $this->getModel('exampleform');
        $view = $this->getView('exampleform', 'html');
        $view->setModel($model, true);
        $view->display();
    }
}