<?php
namespace My\Component\Exampleform\Site\Rule;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Form\FormRule;

class NoasteriskRule extends FormRule
{
    // regex to allow anything except an asterisk
    protected $regex = '^[^\*]+$';
}