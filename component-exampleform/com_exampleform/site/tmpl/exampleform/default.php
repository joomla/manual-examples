<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

// set up client-side validation - we also need class="form-validate" on the <form> below and
// will also need to set the js validation rule in the class attribute of the field in the form XML file
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->useScript('form.validate');

// include the no-uppercase.js script for client validation
// (This will pull in form.validate as a dependency, so the above line isn't really necessary in this case)
$wa->useScript('com_exampleform.validate-no-uppercase');

?>
<form action="<?php echo Route::_('index.php?option=com_exampleform'); ?>"
    class="form-validate" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

    <?php echo $this->form->renderFieldset('mainFieldset');  ?>

    <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('exampleform.submit')">Submit</button>

    <input type="hidden" name="task" />
    <?php echo HtmlHelper::_('form.token'); ?>
</form>