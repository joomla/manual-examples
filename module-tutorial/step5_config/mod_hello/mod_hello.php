<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use My\Module\Hello\Site\Helper\HelloHelper;
use Joomla\CMS\Language\Text;

$username = HelloHelper::getLoggedonUsername("Guest");
$hello = Text::_('MOD_HELLO_GREETING') . $username;

require ModuleHelper::getLayoutPath('mod_hello');
