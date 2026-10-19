<?php

namespace My\Component\Example\Administrator\View\Landmarks;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView {

    function display($tpl = null) 
    {
        $model = $this->getModel();
        $this->items = $model->getItems();
        $this->filterForm = $model->getFilterForm();
        $this->activeFilters = $model->getActiveFilters();
        $this->pagination = $model->getPagination();
        $this->state = $model->getState();
        
        $this->addToolBar();

        parent::display($tpl);
    }
    
    private function addToolBar() 
    {
        ToolBarHelper::title(Text::_('COM_EXAMPLE_LANDMARKS_VIEW_TITLE'), 'camera');
        ToolbarHelper::addNew('landmark.add', 'JTOOLBAR_NEW');   // New button
        $toolbar  = $this->getDocument()->getToolbar();
        $dropdown = $toolbar->dropdownButton('status-group')
            ->text('JTOOLBAR_CHANGE_STATUS')
            ->toggleSplit(false)
            ->icon('icon-ellipsis-h')
            ->buttonClass('btn btn-action')
            ->listCheck(true);
        $childBar = $dropdown->getChildToolbar();
        $childBar->publish('landmarks.publish')->listCheck(true);
        $childBar->unpublish('landmarks.unpublish')->listCheck(true);

        if ($this->state->get('filter.published') != -2) {  // add a "move to trash" button to child toolbar
            $childBar->trash('landmarks.trash')->listCheck(true);
        }
        if ($this->state->get('filter.published') == -2) {  // add an "empty trash" button to main toolbar
            $toolbar->delete('landmarks.delete', 'JTOOLBAR_DELETE_FROM_TRASH')
                ->message('JGLOBAL_CONFIRM_DELETE')
                ->icon('fa fa-circle-xmark')
                ->listCheck(true);
        }
    }
}