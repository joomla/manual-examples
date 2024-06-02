<?php

namespace My\Module\Hello\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
use My\Module\Hello\Site\Helper\HelloHelper;

class Dispatcher implements DispatcherInterface
{
    protected $module;
    
    protected $app;

    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        $this->module = $module;
        $this->app = $app;
    }
    
    public function dispatch()
    {
        $language = $this->app->getLanguage();
        $language->load('mod_hello', JPATH_BASE . '/modules/mod_hello');
        
        $username = HelloHelper::getLoggedonUsername('Guest');

        $hello = Text::_('MOD_HELLO_GREETING') . $username;
        
        $params = new Registry($this->module->params);

        require ModuleHelper::getLayoutPath('mod_hello');
    }
}
