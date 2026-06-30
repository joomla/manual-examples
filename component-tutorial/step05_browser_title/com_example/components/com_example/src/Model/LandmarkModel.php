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

        $table = $this->getTable('Landmark', 'Administrator');
        $result = $table->load($id);
        if ($result) {
            return $table->title;
        } else {
            throw new \UnexpectedValueException("id out of range");
        }
    }
}