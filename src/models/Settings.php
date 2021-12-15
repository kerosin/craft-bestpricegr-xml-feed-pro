<?php
/**
 * Bestpricegr Xml Feed Pro plugin for Craft CMS 3.x
 *
 * @link      https://github.com/kerosin
 * @copyright Copyright (c) 2021 kerosin
 */

namespace kerosin\bestpricegrxmlfeedpro\models;

use Craft;
use craft\base\Model;
use craft\commerce\errors\CurrencyException;
use craft\commerce\Plugin as CommercePlugin;
use craft\helpers\ArrayHelper;

/**
 * @author    kerosin
 * @package   BestpricegrXmlFeedPro
 * @since     1.0.0
 */
class Settings extends Model
{
    // Constants
    // =========================================================================

    const VARIANT_PRICE_TYPE_DEFAULT = 1;
    const VARIANT_PRICE_TYPE_MIN_PRICE = 2;
    const VARIANT_PRICE_TYPE_MAX_PRICE = 3;
    const VARIANT_PRICE_TYPE_AVG_PRICE = 4;

    const OPTION_CUSTOM_VALUE = '__custom_value__';
    const OPTION_USE_WEIGHT_UNIT = '__use_weight_unit__';
    const OPTION_USE_STOCK = '__use_stock__';
    const OPTION_USE_STOCK_FIELD = '__use_stock_field__';

    const STOCK_IN_STOCK = 'Y';
    const STOCK_OUT_OF_STOCK = 'N';
    const STOCK_PRE_ORDER = '';

    /**
     * @since 1.2.0
     */
    const FILTER_STATUS_LIVE = 'live';
    /**
     * @since 1.2.0
     */
    const FILTER_STATUS_PENDING = 'pending';
    /**
     * @since 1.2.0
     */
    const FILTER_STATUS_EXPIRED = 'expired';
    /**
     * @since 1.2.0
     */
    const FILTER_STATUS_ENABLED = 'enabled';
    /**
     * @since 1.2.0
     */
    const FILTER_STATUS_DISABLED = 'disabled';
    /**
     * @since 1.2.0
     */
    const FILTER_STATUS_ARCHIVED = 'archived';

    // Public Properties
    // =========================================================================

    /**
     * Tax rate.
     *
     * @var float
     */
    public $taxRate;

    /**
     * Currency.
     *
     * @var string
     */
    public $currency;

    /**
     * Include out of stock elements.
     *
     * @var bool
     */
    public $includeOutOfStockElements = false;

    /**
     * Append color to ID.
     *
     * @var bool
     */
    public $appendColorToId = true;

    /**
     * Append color to title.
     *
     * @var bool
     */
    public $appendColorToTitle = true;

    /**
     * Append color to url.
     *
     * @var bool
     */
    public $appendColorToUrl = true;

    /**
     * Include out of stock variants.
     *
     * @var bool
     */
    public $includeOutOfStockVariants = false;

    /**
     * Variant price type.
     *
     * @var int
     */
    public $variantPriceType = self::VARIANT_PRICE_TYPE_DEFAULT;

    /**
     * Product ID [productId] field.
     *
     * @var string
     */
    public $productIdField;

    /**
     * Title [title] field.
     *
     * @var string
     */
    public $titleField;

    /**
     * Image [image] field.
     *
     * @var string
     */
    public $imageField;

    /**
     * Additional image [additional_image] field.
     *
     * @var string
     */
    public $additionalImageField;

    /**
     * Price [price] field.
     *
     * @var string
     */
    public $priceField;

    /**
     * Category path [category_path] field.
     *
     * @var string
     */
    public $categoryPathField;

    /**
     * Category id [category_id] field.
     *
     * @var string
     */
    public $categoryIdField;

    /**
     * Availability [availability] field.
     *
     * @var string
     */
    public $availabilityField;

    /**
     * Availability custom value.
     *
     * @var string
     */
    public $availabilityCustomValue;

    /**
     * Availability in stock value.
     *
     * @var string
     */
    public $availabilityInStockValue;

    /**
     * Availability out of stock value.
     *
     * @var string
     */
    public $availabilityOutOfStockValue;

    /**
     * Availability pre-order value.
     *
     * @var string
     */
    public $availabilityPreOrderValue;

    /**
     * Stock [stock] field.
     *
     * @var string
     */
    public $stockField;

    /**
     * Stock custom value.
     *
     * @var string
     */
    public $stockCustomValue;

    /**
     * Brand [brand] field.
     *
     * @var string
     */
    public $brandField;

    /**
     * Brand custom value.
     *
     * @var string
     */
    public $brandCustomValue;

    /**
     * MPN [mpn] field.
     *
     * @var string
     */
    public $mpnField;

    /**
     * ISBN [isbn] field.
     *
     * @var string
     */
    public $isbnField;

    /**
     * Size [size] field.
     *
     * @var string
     */
    public $sizeField;

    /**
     * Color [color] field.
     *
     * @var string
     */
    public $colorField;

    /**
     * Warranty provider [warranty_provider] field.
     *
     * @var string
     */
    public $warrantyProviderField;

    /**
     * Warranty provider custom value.
     *
     * @var string
     */
    public $warrantyProviderCustomValue;

    /**
     * Warranty duration [warranty_duration] field.
     *
     * @var string
     */
    public $warrantyDurationField;

    /**
     * Warranty duration custom value.
     *
     * @var string
     */
    public $warrantyDurationCustomValue;

    /**
     * Bundle [bundle] field.
     *
     * @var string
     */
    public $bundleField;

    /**
     * Weight [weight] field.
     *
     * @var string
     */
    public $weightField;

    /**
     * Weight unit field.
     *
     * @var string
     */
    public $weightUnitField;

    /**
     * Weight unit custom value.
     *
     * @var string
     */
    public $weightUnitCustomValue;

    /**
     * Shipping [shipping] field.
     *
     * @var string
     */
    public $shippingField;

    /**
     * Shipping custom value.
     *
     * @var string
     */
    public $shippingCustomValue;

    /**
     * Features.
     *
     * @var array
     */
    public $features;

    /**
     * Entry status filter.
     *
     * @var array
     * @since 1.2.0
     */
    public $entryStatusFilter = [self::FILTER_STATUS_LIVE];

    /**
     * Entry type filter.
     *
     * @var array
     * @since 1.2.0
     */
    public $entryTypeFilter = [];

    /**
     * Entry category filter.
     *
     * @var array
     * @since 1.2.0
     */
    public $entryCategoryFilter = [];

    /**
     * Product status filter.
     *
     * @var array
     * @since 1.2.0
     */
    public $productStatusFilter = [self::FILTER_STATUS_LIVE];

    /**
     * Product type filter.
     *
     * @var array
     * @since 1.2.0
     */
    public $productTypeFilter = [];

    /**
     * Product category filter.
     *
     * @var array
     * @since 1.2.0
     */
    public $productCategoryFilter = [];

    /**
     * Product available for purchase filter.
     *
     * @var string
     * @since 1.2.0
     */
    public $productAvailableForPurchaseFilter;

    // Public Methods
    // =========================================================================

    /**
     * @return array
     */
    public static function getCmsStandardFields(): array
    {
        return [
            'id' => Craft::t('bestpricegr-xml-feed-pro', 'ID'),
            'title' => Craft::t('bestpricegr-xml-feed-pro', 'Title'),
            'expiryDate' => Craft::t('bestpricegr-xml-feed-pro', 'Expiry Date'),
        ];
    }

    /**
     * @return array
     */
    public static function getCommerceStandardFields(): array
    {
        return [
            'sku' => Craft::t('bestpricegr-xml-feed-pro', 'SKU'),
            'price' => Craft::t('bestpricegr-xml-feed-pro', 'Price'),
            'salePrice' => Craft::t('bestpricegr-xml-feed-pro', 'Sale Price'),
            'length' => Craft::t('bestpricegr-xml-feed-pro', 'Dimensions (L)'),
            'width' => Craft::t('bestpricegr-xml-feed-pro', 'Dimensions (W)'),
            'height' => Craft::t('bestpricegr-xml-feed-pro', 'Dimensions (H)'),
            'weight' => Craft::t('bestpricegr-xml-feed-pro', 'Weight'),
        ];
    }

    /**
     * @return array
     */
    public function getStandardFields(): array
    {
        $result = self::getCmsStandardFields();

        if (Craft::$app->getPlugins()->isPluginInstalled('commerce')) {
            $result = array_merge($result, self::getCommerceStandardFields());
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getCustomFields(): array
    {
        $result = [];

        foreach (Craft::$app->getFields()->getAllFields() as $field) {
            $result[$field->handle] = $field->name;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getFieldOptions(): array
    {
        $result = [];
        $fields = $this->getStandardFields();

        if (count($fields)) {
            $result[] = ['optgroup' => Craft::t('bestpricegr-xml-feed-pro', 'Standard Fields')];

            foreach ($fields as $handle => $name) {
                $result[] = [
                    'value' => $handle,
                    'label' => $name,
                ];
            }
        }

        $fields = $this->getCustomFields();

        if (count($fields)) {
            $result[] = ['optgroup' => Craft::t('bestpricegr-xml-feed-pro', 'Custom Fields')];

            foreach ($fields as $handle => $name) {
                $result[] = [
                    'value' => $handle,
                    'label' => $name,
                ];
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getCurrencyOptions(): array
    {
        $result = [];

        if (!Craft::$app->getPlugins()->isPluginInstalled('commerce')) {
            return $result;
        }

        try {
            $currencies = CommercePlugin::getInstance()->getPaymentCurrencies()->getAllPaymentCurrencies();

            foreach ($currencies as $currency) {
                $result[] = [
                    'value' => $currency->iso,
                    'label' => $currency->iso,
                ];
            }
        } catch (CurrencyException $e) {
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getVariantPriceTypeOptions(): array
    {
        return [
            self::VARIANT_PRICE_TYPE_DEFAULT => Craft::t('bestpricegr-xml-feed-pro', 'Default Variant'),
            self::VARIANT_PRICE_TYPE_MIN_PRICE => Craft::t('bestpricegr-xml-feed-pro', 'Minimum Price'),
            self::VARIANT_PRICE_TYPE_MAX_PRICE => Craft::t('bestpricegr-xml-feed-pro', 'Maximum Price'),
            self::VARIANT_PRICE_TYPE_AVG_PRICE => Craft::t('bestpricegr-xml-feed-pro', 'Average Price'),
        ];
    }

    /**
     * @return array
     * @since 1.2.0
     */
    public function getStatusFilterOptions(): array
    {
        return [
            self::FILTER_STATUS_LIVE => Craft::t('bestpricegr-xml-feed-pro', 'Live'),
            self::FILTER_STATUS_PENDING => Craft::t('bestpricegr-xml-feed-pro', 'Pending'),
            self::FILTER_STATUS_EXPIRED => Craft::t('bestpricegr-xml-feed-pro', 'Expired'),
            self::FILTER_STATUS_ENABLED => Craft::t('bestpricegr-xml-feed-pro', 'Enabled'),
            self::FILTER_STATUS_DISABLED => Craft::t('bestpricegr-xml-feed-pro', 'Disabled'),
            self::FILTER_STATUS_ARCHIVED => Craft::t('bestpricegr-xml-feed-pro', 'Archived'),
        ];
    }

    /**
     * @return array
     * @since 1.2.0
     */
    public function getEntryTypeFilterOptions(): array
    {
        $result = [];
        $sections = Craft::$app->getSections()->getAllSections();

        foreach ($sections as $section) {
            foreach ($section->getEntryTypes() as $entryType) {
                $result[] = [
                    'value' => $entryType->id,
                    'label' => Craft::t('site', $section->name) . ' - ' . Craft::t('site', $entryType->name),
                ];
            }
        }

        return $result;
    }

    /**
     * @return array
     * @since 1.2.0
     */
    public function getProductTypeFilterOptions(): array
    {
        $result = [];

        if (!Craft::$app->getPlugins()->isPluginInstalled('commerce')) {
            return $result;
        }

        $productTypes = CommercePlugin::getInstance()->getProductTypes()->getAllProductTypes();

        foreach ($productTypes as $productType) {
            $result[] = [
                'value' => $productType->id,
                'label' => Craft::t('site', $productType->name),
            ];
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $fieldOptions = array_merge(
            [
                self::OPTION_CUSTOM_VALUE,
                self::OPTION_USE_WEIGHT_UNIT,
                self::OPTION_USE_STOCK,
                self::OPTION_USE_STOCK_FIELD,
            ],
            array_keys($this->getStandardFields()),
            array_keys($this->getCustomFields())
        );
        $currencyOptions = array_keys($this->getCurrencyOptions());
        $variantPriceTypeOptions = array_keys($this->getVariantPriceTypeOptions());
        $statusFilterOptions = array_keys($this->getStatusFilterOptions());
        $entryTypeFilterOptions = ArrayHelper::getColumn($this->getEntryTypeFilterOptions(), 'value');
        $productTypeFilterOptions = ArrayHelper::getColumn($this->getProductTypeFilterOptions(), 'value');

        return [
            ['taxRate', 'number'],
            ['currency', 'in', 'range' => $currencyOptions],
            ['includeOutOfStockElements', 'boolean'],
            ['appendColorToId', 'boolean'],
            ['appendColorToTitle', 'boolean'],
            ['appendColorToUrl', 'boolean'],
            ['includeOutOfStockVariants', 'boolean'],
            ['variantPriceType', 'in', 'range' => $variantPriceTypeOptions],
            ['productIdField', 'in', 'range' => $fieldOptions],
            ['titleField', 'in', 'range' => $fieldOptions],
            ['imageField', 'in', 'range' => $fieldOptions],
            ['additionalImageField', 'in', 'range' => $fieldOptions],
            ['priceField', 'in', 'range' => $fieldOptions],
            ['categoryPathField', 'in', 'range' => $fieldOptions],
            ['categoryIdField', 'in', 'range' => $fieldOptions],
            ['availabilityField', 'in', 'range' => $fieldOptions],
            ['stockField', 'in', 'range' => $fieldOptions],
            ['brandField', 'in', 'range' => $fieldOptions],
            ['mpnField', 'in', 'range' => $fieldOptions],
            ['isbnField', 'in', 'range' => $fieldOptions],
            ['sizeField', 'in', 'range' => $fieldOptions],
            ['colorField', 'in', 'range' => $fieldOptions],
            ['warrantyProviderField', 'in', 'range' => $fieldOptions],
            ['warrantyDurationField', 'in', 'range' => $fieldOptions],
            ['bundleField', 'in', 'range' => $fieldOptions],
            ['weightField', 'in', 'range' => $fieldOptions],
            ['weightUnitField', 'in', 'range' => $fieldOptions],
            ['shippingField', 'in', 'range' => $fieldOptions],
            ['entryStatusFilter', 'in', 'allowArray' => true, 'range' => $statusFilterOptions],
            ['entryTypeFilter', 'in', 'allowArray' => true, 'range' => $entryTypeFilterOptions],
            ['productStatusFilter', 'in', 'allowArray' => true, 'range' => $statusFilterOptions],
            ['productTypeFilter', 'in', 'allowArray' => true, 'range' => $productTypeFilterOptions],
        ];
    }
}
