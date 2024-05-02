<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$data = "Hello";

require ModuleHelper::getLayoutPath('mod_hello');
