<?php

namespace My\Module\Hello\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher implements DispatcherInterface, HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    public function dispatch()
    {
        $hello = 'Hello ' . $this->getHelperFactory()->getHelper('HelloHelper')->getLoggedonUsername('Guest');

        require ModuleHelper::getLayoutPath('mod_hello');
    }
}
