<?php
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Helper\ModuleHelper;
use My\Module\Hello\Site\Helper\HelloHelper;
use Joomla\CMS\Language\Text;

$username = HelloHelper::getLoggedonUsername("Guest");
$data = Text::_('MOD_HELLO_GREETING') . $username;

require ModuleHelper::getLayoutPath('mod_hello');
