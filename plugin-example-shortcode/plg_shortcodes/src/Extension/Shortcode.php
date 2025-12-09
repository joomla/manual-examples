<?php
namespace My\Plugin\Content\Shortcodes\Extension;

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Event\Content\ContentPrepareEvent;
use Joomla\CMS\Event\Content\AfterTitleEvent;
use Joomla\Event\SubscriberInterface;
use Joomla\CMS\Language\Text;

class Shortcode extends CMSPlugin implements SubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
                'onContentPrepare' => 'replaceShortcodes',  
                'onContentAfterTitle' => 'addShortcodeSubtitle',  
                ];
    }

    // this will be called whenever the onContentPrepare event is triggered
    public function replaceShortcodes(ContentPrepareEvent $event): void
    {
        /* This function processes the text of an article being presented on the site.
         * It replaces any text of the form "{configname}" (where configname is the name 
         * of a config parameter in configuration.php) with the value of the parameter.
         */
        
        // We used setApplication on our plugin instance inside services/provider.php to set the Application instance
        // Now we can retrieve it here using getApplication.
        // getApplication and setApplication are inherited from CMSPlugin
        $app = $this->getApplication();
        
        // The line below restricts the functionality to the front-end site (ie not admin/api/console job)
        // You may not want this, so you need to consider this in your own plugins
        if (!$app->isClient('site')) {
            return;
        }
        
        // Find out if this event relates to an article or something else (eg contact, user)
        $context = $event->getContext();
        if ($context !== "com_content.article" && $context !== "com_content.featured") return;
        
        // If we've reached here then it's an article - get the 'text' property
        $article = $event->getItem();
        $text = $article->text; // text of the article
        
        $config = $app->getConfig()->toArray();  // config params as an array
            // (we can't do a foreach over the config params as a Registry because they're protected)
        
        // the following is just code to replace {configname} with the parameter value
        $offset = 0;
        // find opening curly brackets ...
        while (($start = strpos($text, "{", $offset)) !== false) {
            // find the corresponding closing bracket and extract the "shortcode"
            if ($end = strpos($text, "}", $start)) {
               $shortcode = substr($text, $start + 1, $end - $start - 1);
               
               // cycle through the config array looking for a match
               $match_found = false;
               foreach ($config as $key => $value) {
                   if ($key === $shortcode) {
                       $text = substr_replace($text, htmlspecialchars($value), $start, $end - $start + 1);
                       $match_found = true;
                       break;
                   }
                } 
                
                // if no match found replace it with an error string
                if (!$match_found) {
                    $this->loadLanguage();  // you need to load the plugin's language constants before using them
                    // (alternatively you can set:  protected $autoloadLanguage = true; and Joomla will load it for you)
                    $text = substr_replace($text, Text::_('PLG_CONTENT_SHORTCODES_NO_MATCH'), $start, $end - $start + 1);
                }
                
            } else {
               break;
            }
           
           $offset = $end;
        }

        // now update the article text with the processed text
        $article->text = $text;
    }
    
    public function addShortcodeSubtitle(AfterTitleEvent $event): void
    {
        /* This function adds a subtitle to a page on the site front end:
         * "Processed for shortcodes" - if the page is an article
         * "Not processed for shortcodes" - if the page is a contact, etc.
         */
         
        if (!$this->getApplication()->isClient('site')) return;
        
        $context = $event->getContext();
        $this->loadLanguage();
        if ($context === "com_content.article" || $context === "com_content.featured") 
        {
            $event->addResult(Text::_('PLG_CONTENT_SHORTCODES_PROCESSED'));
        } else {
            $event->addResult(Text::_('PLG_CONTENT_SHORTCODES_NOT_PROCESSED'));
        }
    }
}