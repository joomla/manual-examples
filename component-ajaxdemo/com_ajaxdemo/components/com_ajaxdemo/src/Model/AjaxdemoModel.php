<?php
namespace My\Component\Ajaxdemo\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class AjaxdemoModel extends \Joomla\CMS\MVC\Model\FormModel
{

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_ajaxdemo.divide',      // a unique name to identify the form
            'divide_form',              // the filename of the XML form definition
                                        // Joomla will look in the site/forms folder for this file
            array(
                'control' => 'jform',    // the name of the array for the POST parameters
                                         // the id of fields in the form will then be jform_<field name>
                'load_data' => $loadData // if set to true, then there will be a callback to 
                                         // loadFormData to supply the data
            )
        );

        if (empty($form))
        {
            $errors = $this->getErrors();
            throw new \Exception(implode("\n", $errors), 500);
        }

        return $form;
    }

    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = Factory::getApplication()->getUserState(
            'com_ajaxdemo.divide',  // a unique name to identify the data in the session
            []                 // no pre-fill data otherwise
        );

        return $data;
    }

}