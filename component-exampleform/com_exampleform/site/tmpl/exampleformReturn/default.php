<?php
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
?>

<h2>Raw Data</h2>
<?php var_dump($this->rawData);  ?>

<h2>Validated Data</h2>
<?php var_dump($this->validatedData);  ?>

<br/>

<a href="<?php echo Route::_('index.php?option=com_exampleform'); ?>">Return to form</a>
