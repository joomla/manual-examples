<?php

namespace My\Component\Ajaxdemo\Site\View\Ajaxdemo;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        $this->form = $this->getModel()->getForm();
        
        parent::display($tpl);
    }
}
