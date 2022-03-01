<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Model\Data;

use Loop\MiniTracker\Api\Data\TrackingInfoInterface;

class TrackingInfo extends \Magento\Framework\Api\AbstractExtensibleObject implements TrackingInfoInterface
{

    /**
     * Get trackinginfo_id
     * @return string|null
     */
    public function getTrackinginfoId()
    {
        return $this->_get(self::TRACKINGINFO_ID);
    }

    /**
     * Set trackinginfo_id
     * @param string $trackinginfoId
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setTrackinginfoId($trackinginfoId)
    {
        return $this->setData(self::TRACKINGINFO_ID, $trackinginfoId);
    }

    /**
     * Get sku
     * @return string|null
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * Set sku
     * @param string $sku
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Loop\MiniTracker\Api\Data\TrackingInfoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Loop\MiniTracker\Api\Data\TrackingInfoExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get tracking_code
     * @return string|null
     */
    public function getTrackingCode()
    {
        return $this->_get(self::TRACKING_CODE);
    }

    /**
     * Set tracking_code
     * @param string $trackingCode
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setTrackingCode($trackingCode)
    {
        return $this->setData(self::TRACKING_CODE, $trackingCode);
    }

    /**
     * Get tracking_message
     * @return string|null
     */
    public function getTrackingMessage()
    {
        return $this->_get(self::TRACKING_MESSAGE);
    }

    /**
     * Set tracking_message
     * @param string $trackingMessage
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setTrackingMessage($trackingMessage)
    {
        return $this->setData(self::TRACKING_MESSAGE, $trackingMessage);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}

