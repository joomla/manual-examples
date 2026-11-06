<?php
namespace My\Component\Example\Administrator\Rule;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormRule;
use Joomla\Registry\Registry;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Text;

\defined('_JEXEC') or die;

class ReferenceRule extends FormRule
{
    public function test(\SimpleXMLElement $element, $value, $group = null, ?Registry $input = null, ?Form $form = null)
    {
        if ($value === '' || $value === null) {   // reference is optional
            return true;
        }
        
        // get the allowable reference organisations from component config, and convert to an array
        $params = ComponentHelper::getParams('com_example');
        $refOrgs = $params->get('referenceOrganisations');
        $orgs = explode(",", $refOrgs);
        
        // the value of the field must start with one of these reference organisations
        foreach ($orgs as $org) {
            if (str_starts_with($value, $org)) {
                return true;
            }
        }
        
        // The $element parameter passed in is the <field> element within the XML file
        // We set the message= attribute of this (if it's not already set) to be an error message
        // which includes the list of reference organisations
        $attr = $element->attributes();
        $error_message = sprintf(Text::_('COM_EXAMPLE_INVALID_REFERENCE'), $refOrgs);
        if (!isset($attr['message'])) {
            $element->addAttribute('message', $error_message);
        }
        
        return false;
    }
}