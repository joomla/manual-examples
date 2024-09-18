<?php

namespace My\Component\Exampleform\Site\View\ExampleformReturn;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    public function setData($rawData, $validatedData)
    {
        $this->rawData = $rawData;
        $this->validatedData = $validatedData;
    }
}
