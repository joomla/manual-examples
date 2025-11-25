<?php

namespace My\Module\TableExample\Site\Helper;

use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use My\Module\TableExample\Site\Table\ExampleModuleTable;

\defined('_JEXEC') or die;

class ExampleTableHelper implements DatabaseAwareInterface
{
    use DatabaseAwareTrait;
    
    /*
     * doBasicTableOperations demonstrates use of the basic Table methods
     *
     * $id - the id of this module 
     * $input - the Joomla Input instance
     */
    public function doBasicTableOperations($id, $input)
    {
        // by setting the DatabaseAwareInterface and DatabaseAwareTrait 
        // Joomla makes available the Database object via an instance method getDatabase()
        $moduleTable = new ExampleModuleTable($this->getDatabase());
        
        // we load the database record in the #__modules table which relates to this module
        if ($moduleTable->load($id))
        {
            // demonstrates that the properties are set via the load() call
            echo "Module title is {$moduleTable->title}<br>";
            
            // The header tag is held as one of the JSON-encoded params, so we need to decode the params
            $moduleParams = json_decode($moduleTable->params, true);
            $moduleParams['header_tag'] = 'h2';
            // The params will be JSON-encoded in the bind() method before storing in the database because we set in our table class
            // $_jsonEncode = array('params');
            
            // get the demonote= HTTP GET parameter and put it into the note field
            $note = $input->get('demonote', '', "STRING");
            $data = array("note" => $note, "params" => $moduleParams); 

            // bind the updated data in the $data array
            $moduleTable->bind($data);

            $moduleTable->check();

            // store the data - this will result in a SQL UPDATE to this module's record in the #__modules table
            $moduleTable->store(); 
        }
    }
    
    /*
     * doAdvancedTableOperations demonstrates use of the advanced Table methods
     *
     * $id - the id of this module 
     * $input - the Joomla Input instance
     */
    public function doAdvancedTableOperations($id, $input)
    {
        $moduleTable = new ExampleModuleTable($this->getDatabase());
        $user = \Joomla\CMS\Factory::getApplication()->getIdentity();
        
        if ($moduleTable->load($id))
        {
            // checkout/checkin
            if ($moduleTable->isCheckedOut($user->id))
            {
                echo "<br>module record isCheckedOut call returned true<br>";
            }
            else
            {
                echo "<br>module record isCheckedOut call returned false<br>";
            }
            
            // Read ACL rules - you can also try moving this code to after the setRules() call
            if ($rules = $moduleTable->getRules())
            {
                $rulesString = (string) $rules;
                echo "<br>ACL Rules: $rulesString <br>";
            }
            else
            {
                echo "<br>As expected, getRules() didn't return anything<br>";
            }
            
            // Set the ACL on this module
            $userGroups = $user->getAuthorisedGroups();
            $randomIndex = array_rand($userGroups);
            $newRule = array("core.edit" => array($userGroups[$randomIndex] => 1));
            echo "Setting rules to " . json_encode($newRule) . "<br>";
            $moduleTable->setRules($newRule);
            $moduleTable->store();
            
            // Ordering - change the ordering with other modules in the same template position
            $where = 'POSITION = "' . $moduleTable->position . '"';
            echo "<br>Next order value: " . $moduleTable->getNextOrder($where) . "<br>";
            
            $moduleTable->move(2, $where);
            echo "Ordering value is now: {$moduleTable->ordering}<br>";
            
            $where .= " and published = 1";
            $moduleTable->reorder($where);
            
            // Reflection method - getTableName
            echo "<br>Table name is {$moduleTable->getTableName()}<br>";
        }
    }
}