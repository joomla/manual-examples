<?php
namespace My\Component\Exampleform\Site\Field;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Form\FormField;

class MytimeField extends FormField
{
    protected $type = 'Mytime';

    protected function getInput()
    {
        // Set attributes - here just the CSS class for the input element, if specified
        $attr = !empty($this->class) ? ' class="' . $this->class . '"' : '';

        // set up html, including the value and other attributes
        $html = '<input type="time" name="' . $this->name . '" value="' . $this->value . '"' . $attr . '/>';

        return $html;
    }
}