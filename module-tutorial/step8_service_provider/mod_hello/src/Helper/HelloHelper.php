<?php

namespace My\Module\Hello\Site\Helper;

use Joomla\CMS\Factory;

\defined('_JEXEC') or die;

class HelloHelper
{
    public function getLoggedonUsername(string $default)
    {
        $user = Factory::getApplication()->getIdentity();
        if ($user->id !== 0)  // found a logged-on user
        {
            return $user->username;
        }
        else
        {
            return $default;
        }
    }
}