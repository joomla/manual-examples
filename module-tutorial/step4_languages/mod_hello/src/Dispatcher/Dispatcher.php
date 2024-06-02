<?php

namespace My\Module\Hello\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use My\Module\Hello\Site\Helper\HelloHelper;

class Dispatcher implements DispatcherInterface
{
    public function dispatch()
    {
        $language = Factory::getApplication()->getLanguage();
        $language->load('mod_hello', JPATH_BASE . '/modules/mod_hello');
        
        $username = HelloHelper::getLoggedonUsername('Guest');

        $hello = Text::_('MOD_HELLO_GREETING') . $username;

        require ModuleHelper::getLayoutPath('mod_hello');
    }
}
