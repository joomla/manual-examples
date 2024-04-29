<?php
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Helper\ModuleHelper;
use My\Module\Hello\Site\Helper\HelloHelper;

$username = HelloHelper::getLoggedonUsername("Guest");
$data = "Hello {$username}";

require ModuleHelper::getLayoutPath('mod_hello');
