<?php
namespace My\Component\Example\Site\Model;
 
\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;

class LandmarkModel extends ItemModel
{
    function getItem($pk = null)
    {
        $app = Factory::getApplication();
        $input = $app->getInput();
        $id = $input->get('id', 0, 'INT');
        switch ($id)
            {
                case 1:
                    return "The Eiffel Tower";
                case 2:
                    return "The Giant's Causeway";
                default:
                    throw new \UnexpectedValueException("id out of range");
            }
    }
}