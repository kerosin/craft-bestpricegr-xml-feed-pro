<?php
/**
 * Bestpricegr Xml Feed Pro plugin for Craft CMS 3.x
 *
 * @link      https://github.com/kerosin
 * @copyright Copyright (c) 2021 kerosin
 */

namespace kerosin\bestpricegrxmlfeedpro\variables;

use kerosin\bestpricegrxmlfeedpro\BestpricegrXmlFeedPro;
use kerosin\bestpricegrxmlfeedpro\services\BestpricegrXmlFeedProService;

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
     * @param Element[] $elements
     * @return void
     * @throws Exception
     */
    public function generateFeed(array $elements): void
    {
        $this->getService()->generateFeed($elements);
    }

    /**
     * @param Element $element
     * @param string|null $field
     * @param mixed $customValue
     * @return mixed
     * @throws Exception
     */
    public function elementFieldValue(Element $element, ?string $field, $customValue = null)
    {
        return $this->getService()->getElementFieldValue($element, $field, $customValue);
    }

    /**
     * @param Element $element
     * @return mixed
     * @throws Exception
     */
    public function elementStockFieldValue(Element $element)
    {
        return $this->getService()->getElementStockFieldValue($element);
    }

    /**
     * @param Element $element
     * @return array
     * @throws Exception
     */
    public function elementColors(Element $element): array
    {
        return $this->getService()->getElementColors($element);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isCustomValue(?string $value): bool
    {
        return $this->getService()->isCustomValue($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isUseWeightUnit(?string $value): bool
    {
        return $this->getService()->isUseWeightUnit($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isUseStock(?string $value): bool
    {
        return $this->getService()->isUseStock($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isUseStockField(?string $value): bool
    {
        return $this->getService()->isUseStockField($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isElementInStock(?string $value): bool
    {
        return $this->getService()->isElementInStock($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isElementOutOfStock(?string $value): bool
    {
        return $this->getService()->isElementOutOfStock($value);
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function isElementPreOrder(?string $value): bool
    {
        return $this->getService()->isElementPreOrder($value);
    }

    // Protected Methods
    // =========================================================================

    /**
     * @return BestpricegrXmlFeedProService
     * @since 1.2.0
     */
    protected function getService(): BestpricegrXmlFeedProService
    {
        return BestpricegrXmlFeedPro::$plugin->bestpricegrXmlFeedProService;
    }
}
