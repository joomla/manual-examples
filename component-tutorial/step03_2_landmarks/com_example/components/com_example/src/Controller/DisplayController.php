<?php
namespace My\Component\Example\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController {

    public function display($cachable = false, $urlparams = array())
    {
        $view = $this->getView('landmark', 'html');
        $model = $this->getModel('landmark');
        $view->setModel($model, true);
        $view->display();
    }
}