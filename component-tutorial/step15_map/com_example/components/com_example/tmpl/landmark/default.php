<?php
\defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$this->document->getWebAssetManager()->usePreset("com_example.map");

// Prepare the location data for sending to the JavaScript code
if ($this->data->location) {
    $location = json_decode($this->data->location);
    $lat = $location->lat ?? "";
    $long = $location->long ?? "";
    $locationDefined = (strlen($lat) > 0) && (strlen($long) > 0);
} else {
    $lat = '0';
    $long = '0';
    $locationDefined = false;
}

// Pass the language constant and location data down to JS
Text::script('COM_EXAMPLE_LANDMARK_LOCATION_NOT_DEFINED');
$mapParams = ['landmark' => $this->data->title, 'latitude' => $lat, 'longitude' => $long, 'locationDefined' => $locationDefined];
$this->document->addScriptOptions('com_example.mapParams', $mapParams);
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
<div id="map"></div>