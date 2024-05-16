<?php
defined('_JEXEC') or die;

class ModHelloHelper 
{
    public static function countAjax() {
        throw new Exception('Division by zero.');
        return (string)56;
    }
}