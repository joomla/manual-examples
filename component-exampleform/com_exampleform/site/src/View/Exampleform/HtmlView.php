<?php

namespace My\Component\Exampleform\Site\View\Exampleform;

defined('_JEXEC') or die('Restricted access');

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
