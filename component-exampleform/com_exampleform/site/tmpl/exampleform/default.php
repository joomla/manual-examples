<?php
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
?>
<form action="<?php echo Route::_('index.php?option=com_exampleform'); ?>"
    method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

    <?php echo $this->form->renderFieldset('mainFieldset');  ?>

    <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('exampleform.submit')">Submit</button>

    <input type="hidden" name="task" />
    <?php echo HtmlHelper::_('form.token'); ?>
</form>