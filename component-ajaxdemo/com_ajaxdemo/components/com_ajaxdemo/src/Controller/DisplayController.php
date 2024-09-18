<?php

namespace My\Component\Ajaxdemo\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController {
    
    public function display($cachable = false, $urlparams = array())
    {
        $model = $this->getModel('ajaxdemo');
        $view = $this->getView('ajaxdemo', 'html');
        $view->setModel($model, true);
        $view->display();
    }
}