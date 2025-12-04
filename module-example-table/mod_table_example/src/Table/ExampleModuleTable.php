<?php

namespace My\Module\TableExample\Site\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseInterface;
use Joomla\Event\DispatcherInterface;

\defined('_JEXEC') or die;

class ExampleModuleTable extends Table 
{
    // The elements in this $_jsonEncode array will be JSON-encoded in the bind() call
    // before the data is written to the database (in store()).
    protected $_jsonEncode = array('params');
    
    /**
     * @param   DatabaseInterface     $db          Database connector object
     * @param   ?DispatcherInterface  $dispatcher  Event dispatcher for this table
     */
    public function __construct(DatabaseInterface $db, ?DispatcherInterface $dispatcher = null)
    {
        // We use the functionality of the Joomla Table class
        // We need to pass the name of the database table, and the primary key, plus pass in the database object
        parent::__construct('#__modules', 'id', $db, $dispatcher);
    }
    
    function check()
    {
        // just change the value of the 'note' property
        $this->note .= " added via module";
        return true;
    }
    
    protected function _getAssetName()
    {
        return "com_modules.module." . $this->id;
    }

    protected function _getAssetTitle()
    {
        return $this->title;
    }

    // this function copied from the ModuleTable in src/Table/Module.php 
    protected function _getAssetParentId(?Table $table = null, $id = null)
    {
        $assetId = null;

        // This is a module that needs to parent with the extension.
        if ($assetId === null) {
            // Build the query to get the asset id of the parent component.
            $db    = $this->getDatabase();
            $query = $db->getQuery(true)
                ->select($db->quoteName('id'))
                ->from($db->quoteName('#__assets'))
                ->where($db->quoteName('name') . ' = ' . $db->quote('com_modules'));

            // Get the asset id from the database.
            $db->setQuery($query);

            if ($result = $db->loadResult()) {
                $assetId = (int) $result;
            }
        }

        // Return the asset id.
        if ($assetId) {
            return $assetId;
        }

        return parent::_getAssetParentId($table, $id);
    }
}