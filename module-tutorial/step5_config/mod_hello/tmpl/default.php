<?php
defined('_JEXEC') or die;

$h = $params->get('header', 'h4');
$greeting = "<{$h}>{$data}</{$h}>"
?>

<?php echo $greeting; ?>