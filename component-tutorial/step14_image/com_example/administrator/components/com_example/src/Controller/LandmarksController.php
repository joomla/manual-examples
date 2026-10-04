<?php

namespace My\Component\Example\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;

class LandmarksController extends AdminController {

    public function getModel($name = 'Landmark', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }
}