<?php
/**
 * Copyright (c) 2014-2015 eBay Enterprise, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright   Copyright (c) 2014-2015 eBay Enterprise, Inc. (http://www.ebayenterprise.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace eBayEnterprise\RetailOrderManagement\Payload\TaxDutyFee;

interface ITaxedCustomization extends ICustomizationBase
{
    const PRICE_GROUP_INTERFACE =
        '\eBayEnterprise\RetailOrderManagement\Payload\TaxDutyFee\ITaxedMerchandisePriceGroup';
    const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

    /**
     * get a new, empty ITaxedMerchandisePriceGroup object
     * @return ITaxedMerchandisePriceGroup
     */
    public function getEmptyPriceGroup();

    /**
     * Additional charges associated with the customization.
     *
     * @return ITaxedMerchandisePriceGroup
     */
    public function getUpCharge();

    /**
     * @param ITaxedMerchandisePriceGroup
     * @return self
     */
    public function setUpCharge(ITaxedMerchandisePriceGroup $priceGroup);
}
