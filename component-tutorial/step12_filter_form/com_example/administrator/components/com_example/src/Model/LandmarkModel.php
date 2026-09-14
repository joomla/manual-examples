<?php
namespace My\Component\Example\Administrator\Model;
 
\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class LandmarkModel extends AdminModel
{
    function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_example.landmark', // a name you assign to the form - include com_example to make it unique
            'landmark',             // the xml filename - Joomla will find it in forms/landmark.xml
            array(
                'control' => 'jform',       // the name of the parameter in the HTTP POST
                'load_data' => $loadData    // whether to prefill data or not
            )
        );

        if (empty($form))
        {
            return false;
        }

        return $form;
    }
    
    protected function loadFormData()  // the callback function which is called if $loadData was true
    {
        // Check the session for previously entered form data.
        $data = Factory::getApplication()->getUserState('com_example.edit.landmark.data', array());

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }
}