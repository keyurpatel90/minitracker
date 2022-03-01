<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Api\Data;

interface TrackingInfoInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TRACKINGINFO_ID = 'trackinginfo_id';
    const TRACKING_MESSAGE = 'tracking_message';
    const TRACKING_CODE = 'tracking_code';
    const CREATED_AT = 'created_at';
    const SKU = 'sku';

    /**
     * Get trackinginfo_id
     * @return string|null
     */
    public function getTrackinginfoId();

    /**
     * Set trackinginfo_id
     * @param string $trackinginfoId
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setTrackinginfoId($trackinginfoId);

    /**
     * Get sku
     * @return string|null
     */
    public function getSku();

    /**
     * Set sku
     * @param string $sku
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setSku($sku);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Loop\MiniTracker\Api\Data\TrackingInfoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Loop\MiniTracker\Api\Data\TrackingInfoExtensionInterface $extensionAttributes
    );

    /**
     * Get tracking_code
     * @return string|null
     */
    public function getTrackingCode();

    /**
     * Set tracking_code
     * @param string $trackingCode
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setTrackingCode($trackingCode);

    /**
     * Get tracking_message
     * @return string|null
     */
    public function getTrackingMessage();

    /**
     * Set tracking_message
     * @param string $trackingMessage
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setTrackingMessage($trackingMessage);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setCreatedAt($createdAt);
}

