<?php

namespace My\Component\Example\Administrator\View\Landmark;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView {

    function display($tpl = null) {

        $model = $this->getModel();
        $this->form = $model->getForm();
        $this->item = $model->getItem();

        $this->addToolBar();
        
        parent::display($tpl);
    }
    
    private function addToolBar() {

        // Hide Joomla Administrator Main menu
        Factory::getApplication()->getInput()->set('hidemainmenu', true);

        ToolBarHelper::title(Text::_('COM_EXAMPLE_LANDMARK_EDIT'));
        ToolbarHelper::apply('landmark.apply', 'JTOOLBAR_APPLY');   // Save button
        $toolbar  = $this->getDocument()->getToolbar();
        $dropdown = $toolbar->dropdownButton('save-group');
        $childBar = $dropdown->getChildToolbar();
        $childBar->save('landmark.save');           // Save & Close button
        $childBar->save2new('landmark.save2new');   // Save & New button
        $childBar->save2copy('landmark.save2copy'); // Save as Copy button
        ToolbarHelper::cancel('landmark.cancel', 'JTOOLBAR_CLOSE'); // Cancel button
    }
}