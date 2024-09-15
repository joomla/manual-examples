<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Uri\Uri;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->useScript('com_ajaxdemo.divide');

$root = Uri::root();
$document = Factory::getApplication()->getDocument();
$document->addScriptOptions('com_ajaxdemo.uri', array("root" => $root));

?>
<form action="<?php echo Route::_('index.php?option=com_ajaxdemo'); ?>"
    method="post" name="adminForm" id="adminForm">

    <?php echo $this->form->renderField('a');  ?>
    <?php echo $this->form->renderField('b');  ?>

    <button type="button" class="btn btn-primary" onclick="divide();">Divide A by B</button>

    <?php echo $this->form->renderField('answer');  ?>

    <input type="hidden" name="task" />
</form>