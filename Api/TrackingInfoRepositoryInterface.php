<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TrackingInfoRepositoryInterface
{
    /**
     * Retrieve TrackingInfo
     * @param string $trackinginfoId
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($trackinginfoId);

    /**
     * Retrieve All TrackingInfo
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getAll();

    /**
     * Retrieve TrackingInfo matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Loop\MiniTracker\Api\Data\TrackingInfoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

}

