<?php

namespace My\Component\Exampleform\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController {
    
    public function display($cachable = false, $urlparams = array())
    {
        // getModel gets the MVC Factory to instantiate the Model/Exampleform class
        // within our site namespace (\My\Component\Exampleform\Site)
        $model = $this->getModel('exampleform');
        
        // getView gets the MVC Factory to instantiate the View/Exampleform/HtmlView class
        // within our site namespace (\My\Component\Exampleform\Site)
        $view = $this->getView('exampleform', 'html');
        
        // the View needs a pointer to the Model
        $view->setModel($model, true);
        
        $view->display();
    }
}