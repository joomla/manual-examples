<?php
\defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;

?>
<h4><?php echo $this->escape($this->data->title);?></h4>
<?php 
    $picture = json_decode($this->data->picture);
    if ($picture) {
        $src = $picture->imagefile ?? "";
        if (strlen($src) > 0) {
            $clean = HTMLHelper::_('cleanImageURL', $src);
            $altText = $picture->alt_text ? $this->escape($picture->alt_text) : "";
            echo "<img src=\"{$clean->url}\" alt='{$altText}'>";
        }
    }
?>
<p><?php echo $this->data->description;?></p>