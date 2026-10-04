<?php
namespace My\Component\Example\Administrator\Table;
 
\defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseInterface;

class LandmarkTable extends Table
{
    protected $_jsonEncode = ['picture'];
    
    public function __construct(DatabaseInterface $db)
    {
        parent::__construct('#__example_landmarks', 'id', $db);
    }
}