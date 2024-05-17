<?php
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$document = $app->getDocument();
$wa = $document->getWebAssetManager();
$wr = $wa->getRegistry();
$wr->addRegistryFile('media/mod_hello/joomla.asset.json');
$wa->useScript('mod_hello.add-suffix');

// Pass the suffix to add down to js
$document->addScriptOptions('vars', array('suffix' => "!"));

$h = $params->get('header', 'h4');
$greeting = "<{$h} class='mod_hello'>{$hello}</{$h}>";

Text::script('MOD_HELLO_AJAX_OK');
Text::script('JLIB_JS_AJAX_ERROR_OTHER');
?>

<?php echo $greeting; ?>
<div>
    <p><?php echo Text::_('MOD_HELLO_NUSERS'); ?><span class="mod_hello_nusers"></span></p>
    <button onclick="count_users();"><?php echo Text::_('MOD_HELLO_UPDATE_NUSERS'); ?></button>
</div>