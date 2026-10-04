<?php
\defined('_JEXEC') or die;

?>
<h4><?php echo $this->escape($this->data->title);?></h4>
<?php 
    $picture = json_decode($this->data->picture);
    $src = $picture->imagefile;
    $altText = $this->escape($picture->alt_text);
    echo "<img src={$src} alt='{$altText}'>";
?>
<p><?php echo $this->data->description;?></p>