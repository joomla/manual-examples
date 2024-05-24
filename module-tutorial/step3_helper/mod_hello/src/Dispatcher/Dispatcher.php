<?php

namespace My\Module\Hello\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use My\Module\Hello\Site\Helper\HelloHelper;

class Dispatcher implements DispatcherInterface
{
    public function dispatch()
    {
        $username = HelloHelper::getLoggedonUsername('Guest');

        $hello = "Hello {$username}";

        require ModuleHelper::getLayoutPath('mod_hello');
    }
}
