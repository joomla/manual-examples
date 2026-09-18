<?php

namespace My\Component\Example\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Database\ParameterType;

class LandmarksModel extends ListModel
{
    public function __construct($config = [], ?MVCFactoryInterface $factory = null)
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = [
                'id',
                'title',
                'published',
            ];
        }
        parent::__construct($config, $factory);
    }
    
    protected function getListQuery()
    {
        $db = $this->getDatabase();
        $query = $db->getQuery(true);

        $query->select('id, title, published')
            ->from($db->quoteName('#__example_landmarks'));

        // Filtering - by search string
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = '%' . str_replace(' ', '%', trim($search)) . '%';
            $query->where($db->quoteName('title') . ' LIKE :search')
                  ->bind(':search', $search);
        }
        
        // Filtering - by published state
        $published = (string) $this->getState('filter.published');
        if ($published !== '*') {
            if (is_numeric($published)) {
                $state = (int) $published;
                $query->where($db->quoteName('published') . ' = :state')
                    ->bind(':state', $state, ParameterType::INTEGER);
            }
        }

        // Ordering
        $orderCol  = $this->state->get('list.ordering', 'id');
        $orderDirn = $this->state->get('list.direction', 'ASC');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }
    
    protected function populateState($ordering = 'id', $direction = 'asc')
    {
        parent::populateState($ordering, $direction);
    }
}