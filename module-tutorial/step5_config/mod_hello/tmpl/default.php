<?php
defined('_JEXEC') or die('Restricted Access');

$h = $params->get('header');
$greeting = "<{$h}>{$data}</{$h}>"
?>

<?php echo $greeting; ?>