<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Model;

class TrackingManagement implements \Loop\MiniTracker\Api\TrackingManagementInterface
{

    /**
     * {@inheritdoc}
     */
    public function getTracking($param)
    {
        return 'hello api GET return the $param ' . $param;
    }
}

