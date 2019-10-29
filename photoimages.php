<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator;

/**
 * Class PhotoImagesPlugin
 * @package Grav\Plugin
 */
class PhotoImagesPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main event we are interested in
        $this->enable([
            'onPageInitialized' => ['onPageInitialized', 100],
        ]);
    }

    public function onPageInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        $defaults = (array) $this->config->get('plugins.photoimages');
        /** @var Page $page */
        $page = $this->grav['page'];
        if (isset($page->header()->photoimages)) {
            $this->config->set('plugins.photoimages', array_merge($defaults, $page->header()->photoimages));
        }
        if ($this->config->get('plugins.photoimages.active')) {
            $this->enable([
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                //'onPageContentProcessed' => ['onPageContentProcessed', -100000]
            ]);
        }
    }

    public function onTwigSiteVariables()
    {
        $locator = $this->grav['locator'];
        $config = $this->grav['config'];
        /** @var Page $page */
        $page = $this->grav['page'];
        $mode = $config->get('plugins.photoimages.production') ? '.min' : '';

        $bits = [];
        // Add core js
        $bits[] = 'plugin://photoimages/dist/jquery.photoimages'.$mode.'.js';


        // Add the bits
        $assets = $this->grav['assets'];
        $assets->registerCollection('photoimages', $bits);
        $assets->add('photoimages', 100);

        // Insert inline JS code
        $code = "
        jQuery(document).ready(function() {
                // Create photoImages with a seed-based rotation
                jQuery('.frame-tilt').photoImages({
                    boxShadowOffsetX: '10px',
                    boxShadowOffsetY: '10px',
                    boxShadowLength: '10px',
                    boxShadowColor: '#7f7f7f',
                    marginRight: '10px',
                    rotate: 'seed'
                });
            });
        ";
        $assets->addInlineJs($code);
    }

    // If you want to process the page, do so like this:
//    public function onPageContentProcessed()
//    {
//        $config = $this->grav['config'];
//        $page = $this->grav['page'];
//        $content = $page->getRawContent();
//        $fulltag = str_replace('<table', '<table id="tstableid'.$i.'"', $fulltag);
//        $this->grav['page']->setRawContent($content);
//    }
}
