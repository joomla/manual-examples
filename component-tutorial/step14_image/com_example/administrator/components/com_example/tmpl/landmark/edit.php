<?php
defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

?>

<form action="<?php echo Route::_('index.php?option=com_example&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">

    <?php echo $this->form->renderField('title');  ?>
    
    <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'general tab', 'recall' => true, 'breakpoint' => 768]); ?>

    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'general tab', Text::_('COM_EXAMPLE_LANDMARK_GENERAL_TAB')); ?>
    
    <div class="row">
        <div class="col-lg-9">
            <?php echo $this->form->renderField('description');  ?>
        </div>
        
        <div class="col-lg-3">
            <?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
        </div>
    </div>
    
    <?php echo HTMLHelper::_('uitab.endTab'); ?>
    
    <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details tab', Text::_('COM_EXAMPLE_LANDMARK_DETAILS_TAB')); ?>

        <?php echo $this->form->renderFieldset('details');  ?>
    
    <?php echo HTMLHelper::_('uitab.endTab'); ?>
    
    <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
    
    <input type="hidden" name="task" value="" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>