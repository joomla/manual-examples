<?php
defined('_JEXEC') or die;

$document = $app->getDocument();
$wa = $document->getWebAssetManager();
$wr = $wa->getRegistry();
$wr->addRegistryFile('media/mod_hello/joomla.asset.json');
$wa->useScript('mod_hello.add-suffix');

// Pass the suffix to add down to js
$document->addScriptOptions('vars', array('suffix' => "!"));

$h = $params->get('header', 'h4');
$greeting = "<{$h} class='mod_hello'>{$data}</{$h}>"
?>

<?php echo $greeting; ?>
<div>
    <p>Number of users: <span class="mod_hello_nusers"></span></p>
    <button onclick="count_users();">Update</button>
</div>