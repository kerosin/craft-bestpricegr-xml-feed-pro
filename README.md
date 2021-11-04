# BestPrice.gr Xml Feed Pro plugin for Craft CMS 3.x

BestPrice.gr Xml Feed for Craft CMS.

![Plugin Icon](resources/img/plugin-icon.svg)

## License

This plugin requires a commercial license purchasable through the [Craft Plugin Store](https://plugins.craftcms.com/craft-recaptcha-pro).

## Requirements

This plugin requires Craft CMS 3.1.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require kerosin/bestpricegr-xml-feed-pro

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Bestpricegr Xml Feed Pro.

## Configuration

Open the Craft admin and go to Settings → Plugins → BestPrice.gr Xml Feed Pro → Settings.

## Usage

### Entries feed url

    http://example.com/bestpricegr-xml-feed-pro/feed/entries
    
### Products feed url

    http://example.com/bestpricegr-xml-feed-pro/feed/products
    
### Twig function

```twig
{% set entries = craft.entries.section('foo').all() %}
{{ craft.bestpricegrXmlFeedPro.generateFeed(entries) }}
```

```twig
{% set products = craft.products.all() %}
{{ craft.bestpricegrXmlFeedPro.generateFeed(products) }}
```

---

Brought to you by [kerosin](https://github.com/kerosin)