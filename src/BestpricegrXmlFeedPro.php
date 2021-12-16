<?php
/**
 * Bestpricegr Xml Feed Pro plugin for Craft CMS 3.x
 *
 * @link      https://github.com/kerosin
 * @copyright Copyright (c) 2021 kerosin
 */

namespace kerosin\bestpricegrxmlfeedpro;

use kerosin\bestpricegrxmlfeedpro\services\BestpricegrXmlFeedProService;
use kerosin\bestpricegrxmlfeedpro\variables\BestpricegrXmlFeedProVariable;
use kerosin\bestpricegrxmlfeedpro\models\Settings;
use kerosin\bestpricegrxmlfeedpro\web\twig\Extension;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

use Exception;

/**
 * @author    kerosin
 * @package   BestpricegrXmlFeedPro
 * @since     1.0.0
 *
 * @property  BestpricegrXmlFeedProService $bestpricegrXmlFeedProService
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class BestpricegrXmlFeedPro extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * BestpricegrXmlFeedPro::$plugin
     *
     * @var BestpricegrXmlFeedPro
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * Set to `true` if the plugin should have a settings view in the control panel.
     *
     * @var bool
     */
    public $hasCpSettings = true;

    /**
     * Set to `true` if the plugin should have its own section (main nav item) in the control panel.
     *
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->registerTwigExtensions();
        $this->registerRoutes();
        $this->registerVariables();
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     * @throws Exception
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'bestpricegr-xml-feed-pro/settings',
            [
                'settings' => $this->getSettings(),
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getSettingsResponse()
    {
        /** @var craft\web\Controller $controller */
        $controller = Craft::$app->controller;

        return $controller->renderTemplate('settings/plugins/_settings', [
            'plugin' => $this,
            'settingsHtml' => $this->settingsHtml(),
        ]);
    }

    /**
     * Registers twig extensions.
     *
     * @return void
     */
    protected function registerTwigExtensions(): void
    {
        Craft::$app->view->registerTwigExtension(new Extension);
    }

    /**
     * Registers routes.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['bestpricegr-xml-feed-pro/feed/entries'] = 'bestpricegr-xml-feed-pro/feed/entries';
                $event->rules['bestpricegr-xml-feed-pro/feed/products'] = 'bestpricegr-xml-feed-pro/feed/products';
            }
        );
    }

    /**
     * Registers variables.
     *
     * @return void
     */
    protected function registerVariables(): void
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('bestpricegrXmlFeedPro', BestpricegrXmlFeedProVariable::class);
            }
        );
    }
}
