<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Api\Data;

interface TrackingInfoSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get TrackingInfo list.
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface[]
     */
    public function getItems();

    /**
     * Set sku list.
     * @param \Loop\MiniTracker\Api\Data\TrackingInfoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

