<?php
/**
 * Bestpricegr Xml Feed Pro plugin for Craft CMS 3.x
 *
 * @link      https://github.com/kerosin
 * @copyright Copyright (c) 2021 kerosin
 */

namespace kerosin\bestpricegrxmlfeedpro\assetbundles\bestpricegrxmlfeedpro;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    kerosin
 * @package   BestpricegrXmlFeedPro
 * @since     1.0.0
 */
class BestpricegrXmlFeedProAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * Initializes the bundle.
     */
    public function init()
    {
        $this->sourcePath = '@kerosin/bestpricegrxmlfeedpro/assetbundles/bestpricegrxmlfeedpro/dist';

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/app.css',
        ];

        parent::init();
    }
}
