<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$hello = "Hello";

require ModuleHelper::getLayoutPath('mod_hello');
