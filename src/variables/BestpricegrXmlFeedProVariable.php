<?php
/**
 * Bestpricegr Xml Feed Pro plugin for Craft CMS 3.x
 *
 * @link      https://github.com/kerosin
 * @copyright Copyright (c) 2021 kerosin
 */

namespace kerosin\bestpricegrxmlfeedpro\variables;

use kerosin\bestpricegrxmlfeedpro\BestpricegrXmlFeedPro;

use craft\base\Element;

use Exception;

/**
 * @author    kerosin
 * @package   BestpricegrXmlFeedPro
 * @since     1.0.0
 */
class BestpricegrXmlFeedProVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param Element $element
     * @param string|null $field
     * @param mixed $customValue
     * @return mixed
     * @throws Exception
     */
    public function elementFieldValue(Element $element, ?string $field, $customValue = null)
    {
        return BestpricegrXmlFeedPro::$plugin
            ->bestpricegrXmlFeedProService
            ->getElementFieldValue($element, $field, $customValue);
    }

    /**
     * @param Element $element
     * @return mixed
     * @throws Exception
     */
    public function elementStockFieldValue(Element $element)
    {
        return BestpricegrXmlFeedPro::$plugin
            ->bestpricegrXmlFeedProService
            ->getElementStockFieldValue($element);
    }

    /**
     * @param Element $element
     * @return array
     * @throws Exception
     */
    public function elementColors(Element $element): array
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->getElementColors($element);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isCustomValue(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isCustomValue($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isUseWeightUnit(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isUseWeightUnit($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isUseStock(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isUseStock($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isUseStockField(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isUseStockField($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isElementInStock(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isElementInStock($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isElementOutOfStock(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isElementOutOfStock($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isElementPreOrder(?string $value): bool
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->isElementPreOrder($value);
    }

    /**
     * @param Element[] $elements
     * @return void
     * @throws Exception
     */
    public function generateFeed(array $elements): void
    {
        BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService->generateFeed($elements);
    }
}
