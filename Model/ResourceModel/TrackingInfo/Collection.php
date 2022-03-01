<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Model\ResourceModel\TrackingInfo;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'trackinginfo_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Loop\MiniTracker\Model\TrackingInfo::class,
            \Loop\MiniTracker\Model\ResourceModel\TrackingInfo::class
        );
    }
}

