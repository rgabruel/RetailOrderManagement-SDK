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
use eBayEnterprise\RetailOrderManagement\Payload\IValidator;
use eBayEnterprise\RetailOrderManagement\Payload\IValidatorIterator;
use eBayEnterprise\RetailOrderManagement\Payload\PayloadMap;
use eBayEnterprise\RetailOrderManagement\Payload\TPayloadTest;
use eBayEnterprise\RetailOrderManagement\Payload\ValidatorIterator;
use Psr\Log\NullLogger;

class TrackingNumberTest extends \PHPUnit_Framework_TestCase
{
    use TPayloadTest;

    const FULL_FIXTURE_FILE = 'TrackingNumber.xml';

    /** @var IPayloadMap */
    protected $payloadMap;

    /**
     * Setup a stub validator and validator iterator for each payload to use
     */
    public function setUp()
    {
        // use stub to allow validation success/failure to be scripted.
        $this->stubValidator = $this->getMock('\eBayEnterprise\RetailOrderManagement\Payload\IValidator');
        $this->validatorIterator = new ValidatorIterator([$this->stubValidator]);
        $this->stubSchemaValidator = $this->getMock('\eBayEnterprise\RetailOrderManagement\Payload\ISchemaValidator');
        $this->payloadMap = new PayloadMap;

        $this->fullPayload = $this->buildPayload([
            'setTrackingNumber' => 'trackingNumber123',
            'setUrl' => 'http://example.com/track',
        ]);
    }

    protected function createNewPayload()
    {
        return new TrackingNumber($this->validatorIterator, $this->stubSchemaValidator, $this->payloadMap, new NullLogger());
    }

    protected function getCompleteFixtureFile()
    {
        return __DIR__ . '/Fixtures/' . static::FULL_FIXTURE_FILE;
    }

    public function testSerialize()
    {
        $this->assertSame(
            $this->loadXmlTestString($this->getCompleteFixtureFile(), true),
            $this->fullPayload->serialize()
        );
    }

    public function testDeserialize()
    {
        $payload = $this->buildPayload();
        $this->assertEquals(
            $this->fullPayload,
            $payload->deserialize($this->loadXmlTestString($this->getCompleteFixtureFile()))
        );
    }
}
