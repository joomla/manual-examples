<?php

namespace My\Module\Hello\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;

class Dispatcher implements DispatcherInterface
{
    public function dispatch()
    {
        $hello = "Hello";

        require ModuleHelper::getLayoutPath('mod_hello');
    }
}
