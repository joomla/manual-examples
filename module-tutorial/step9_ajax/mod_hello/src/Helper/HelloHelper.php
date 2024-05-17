<?php

namespace My\Module\Hello\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;
use Joomla\Database\DatabaseInterface;
use Joomla\Module\Logged\Administrator\Helper\LoggedHelper;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Language\Text;

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

    public function countAjax() {

        $user = Factory::getApplication()->getIdentity();
        if ($user->id == 0)  // not logged on
        {
            throw new \Exception(Text::_('JERROR_ALERTNOAUTHOR'));
        }
        else
        {
            $params = new Registry(array('count' => 0));
            $app = Factory::getApplication();
            $db = Factory::getContainer()->get(DatabaseInterface::class);
            $users = LoggedHelper::getList($params, $app, $db);
            return (string)count($users);
        }
    }
}