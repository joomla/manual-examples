<?php
namespace My\Component\Example\Administrator\Table;
 
\defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class LandmarkTable extends Table
{
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__landmark', 'id', $db);
    }
}