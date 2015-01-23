<?php
/**
 * Copyright (c) 2013-2014 eBay Enterprise, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright   Copyright (c) 2013-2014 eBay Enterprise, Inc. (http://www.ebayenterprise.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace eBayEnterprise\RetailOrderManagement\Payload\OrderEvents;

use eBayEnterprise\RetailOrderManagement\Payload\IPayloadMap;
use eBayEnterprise\RetailOrderManagement\Payload\ISchemaValidator;
use eBayEnterprise\RetailOrderManagement\Payload\IValidatorIterator;
use eBayEnterprise\RetailOrderManagement\Payload\PayloadFactory;
use eBayEnterprise\RetailOrderManagement\Payload\TPayload;
use eBayEnterprise\RetailOrderManagement\Payload\TIterablePayload;
use SPLObjectStorage;

class PerformedAdjustmentIterable extends SPLObjectStorage implements IPerformedAdjustmentIterable
{
    use TIterablePayload;

    /**
     * @param IValidatorIterator
     * @param ISchemaValidator unused, kept to allow IPayloadMap to be passed
     * @param IPayloadMap
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(
        IValidatorIterator $validators,
        ISchemaValidator $schemaValidator,
        IPayloadMap $payloadMap
    ) {
        $this->validators = $validators;
        $this->payloadMap = $payloadMap;
        $this->payloadFactory = new PayloadFactory();

        $this->includeIfEmpty = true;
    }

    /**
     * Get an empty instance of the adjustment payload
     * @return IPerformedAdjustment
     */
    public function getEmptyPerformedAdjustment()
    {
        return $this->payloadFactory->buildPayload(
            $this->payloadMap->getConcreteType(static::PERFORMED_ADJUSTMENT_INTERFACE),
            $this->payloadMap
        );
    }

    protected function getNewSubpayload()
    {
        return $this->getEmptyPerformedAdjustment();
    }

    protected function getSubpayloadXPath()
    {
        return 'x:' . static::SUBPAYLOAD_XPATH;
    }

    protected function getRootNodeName()
    {
        return static::ROOT_NODE;
    }

    protected function getXmlNamespace()
    {
        return self::XML_NS;
    }
}