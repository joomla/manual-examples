<?php

namespace My\Module\TableExample\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\Dispatcher as JoomlaDispatcher;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher extends JoomlaDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;
    
    /**
     * The module instance
     */
    protected $module;
    
    /**
     * The Joomla Input instance
     */
    protected $input;

    /**
     * Constructor for Dispatcher
     *
     * @param   \stdClass                $module  The module
     * @param   CMSApplicationInterface  $app     The application instance
     * @param   Input                    $input   The input instance
     */
    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        parent::__construct($app, $input);

        $this->module = $module;
        $this->input = $input;
    }
    
    public function dispatch()
    {
        // This is the entry point for our module code
        echo '<h4>Hello ' . $this->module->id . '</h4>';
        
        // Pass the work off into a helper class
        // The default Joomla Factory classes set the Database object within the Helper class,
        // but not within the Dispatcher class, and we need the dbo for passing to the Table
        $helper = $this->getHelperFactory()->getHelper('ExampleTableHelper');
        $helper->doBasicTableOperations($this->module->id, $this->input);
        $helper->doAdvancedTableOperations($this->module->id, $this->input);
    }
}
