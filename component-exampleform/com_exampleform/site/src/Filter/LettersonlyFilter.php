<?php

namespace My\Component\Exampleform\Site\Filter;

defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormFilterInterface;
use Joomla\Registry\Registry;

class LettersonlyFilter implements FormFilterInterface
{
    public function filter(\SimpleXMLElement $element, $value, $group = null, Registry $input = null, Form $form = null)
    {
        // remove all characters which aren't letters
        $lettersOnly = preg_replace("/(?![A-Za-z])./", "", $value);
        return $lettersOnly;
    }
}