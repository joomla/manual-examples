<?php

namespace My\Module\Hello\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class HelloHelper
{
    public function getLoggedonUsername(string $default)
    {
        $user = Factory::getApplication()->getIdentity();

        if ($user->id !== 0) {
            // found a logged-on user
            return $user->username;
        }

        return $default;
    }
}
