<?php
namespace My\Component\Example\Site\Model;
 
\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ItemModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\Registry\Registry;

class LandmarkModel extends ItemModel
{
    function getItem($pk = null)
    {
        $app = Factory::getApplication();
        $input = $app->getInput();
        $id = $input->get('id', 0, 'INT');

        $table = $this->getTable('Landmark', 'Administrator');
        $result = $table->load($id);
        if ($result && $table->published == 1) {
            // convert the landmark record params to a Registry and merge with com_example component params
            $individualLandmarkParams = new Registry($table->params);
            $table->mergedParams = clone $this->getState('params');
            $table->mergedParams->merge($individualLandmarkParams);
            return $table;
        } else {
            throw new \UnexpectedValueException("id out of range");
        }
    }
    
    protected function populateState()
    {
        $params = ComponentHelper::getParams('com_example');
        $this->setState('params', $params);
    }
}