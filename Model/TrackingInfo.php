<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Model;

use Loop\MiniTracker\Api\Data\TrackingInfoInterface;
use Loop\MiniTracker\Api\Data\TrackingInfoInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class TrackingInfo extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'loop_minitracker_trackinginfo';
    protected $trackinginfoDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TrackingInfoInterfaceFactory $trackinginfoDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Loop\MiniTracker\Model\ResourceModel\TrackingInfo $resource
     * @param \Loop\MiniTracker\Model\ResourceModel\TrackingInfo\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TrackingInfoInterfaceFactory $trackinginfoDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Loop\MiniTracker\Model\ResourceModel\TrackingInfo $resource,
        \Loop\MiniTracker\Model\ResourceModel\TrackingInfo\Collection $resourceCollection,
        array $data = []
    ) {
        $this->trackinginfoDataFactory = $trackinginfoDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve trackinginfo model with trackinginfo data
     * @return TrackingInfoInterface
     */
    public function getDataModel()
    {
        $trackinginfoData = $this->getData();
        
        $trackinginfoDataObject = $this->trackinginfoDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $trackinginfoDataObject,
            $trackinginfoData,
            TrackingInfoInterface::class
        );
        
        return $trackinginfoDataObject;
    }
}

