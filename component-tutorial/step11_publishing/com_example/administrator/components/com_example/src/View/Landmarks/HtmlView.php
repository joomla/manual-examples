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
        
        $this->addToolBar();

        parent::display($tpl);
    }
    
    private function addToolBar() 
    {
        ToolBarHelper::title(Text::_('COM_EXAMPLE_LANDMARKS_VIEW_TITLE'), 'camera');
        ToolbarHelper::addNew('landmark.add', 'JTOOLBAR_NEW');   // New button
        ToolbarHelper::deleteList('', 'landmarks.delete', 'JTOOLBAR_DELETE');   // Delete button
        ToolbarHelper::publishList('landmarks.publish', 'JTOOLBAR_PUBLISH');   // Publish button
        ToolbarHelper::unpublishList('landmarks.unpublish', 'JTOOLBAR_UNPUBLISH');   // Unpublish button
    }
}