<?php
defined('_JEXEC') or die;

$document = $app->getDocument();
$wa = $document->getWebAssetManager();
$wr = $wa->getRegistry();
$wr->addRegistryFile('media/mod_hello/joomla.asset.json');
$wa->useScript('mod_hello.add-suffix');

// Pass the suffix to add down to js
$document->addScriptOptions('vars', ['suffix' => '!']);

$h = $params->get('header', 'h4');
$greeting = "<{$h} class='mod_hello'>{$hello}</{$h}>";
?>

<?php echo $greeting; ?>