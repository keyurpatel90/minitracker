<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Model;

use Loop\MiniTracker\Api\Data\TrackingInfoInterfaceFactory;
use Loop\MiniTracker\Api\Data\TrackingInfoSearchResultsInterfaceFactory;
use Loop\MiniTracker\Api\TrackingInfoRepositoryInterface;
use Loop\MiniTracker\Model\ResourceModel\TrackingInfo as ResourceTrackingInfo;
use Loop\MiniTracker\Model\ResourceModel\TrackingInfo\CollectionFactory as TrackingInfoCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class TrackingInfoRepository implements TrackingInfoRepositoryInterface
{

    protected $trackingInfoFactory;

    protected $dataTrackingInfoFactory;

    protected $trackingInfoCollectionFactory;

    protected $dataObjectHelper;

    protected $extensibleDataObjectConverter;
    private $collectionProcessor;

    private $storeManager;

    protected $searchResultsFactory;

    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectProcessor;


    /**
     * @param ResourceTrackingInfo $resource
     * @param TrackingInfoFactory $trackingInfoFactory
     * @param TrackingInfoInterfaceFactory $dataTrackingInfoFactory
     * @param TrackingInfoCollectionFactory $trackingInfoCollectionFactory
     * @param TrackingInfoSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceTrackingInfo $resource,
        TrackingInfoFactory $trackingInfoFactory,
        TrackingInfoInterfaceFactory $dataTrackingInfoFactory,
        TrackingInfoCollectionFactory $trackingInfoCollectionFactory,
        TrackingInfoSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->trackingInfoFactory = $trackingInfoFactory;
        $this->trackingInfoCollectionFactory = $trackingInfoCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTrackingInfoFactory = $dataTrackingInfoFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }


    /**
     * {@inheritdoc}
     */
    public function get($trackingInfoId)
    {
        $trackingInfo = $this->trackingInfoFactory->create();
        $this->resource->load($trackingInfo, $trackingInfoId);
        if (!$trackingInfo->getId()) {
            throw new NoSuchEntityException(__('TrackingInfo with id "%1" does not exist.', $trackingInfoId));
        }
        return $trackingInfo->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->trackingInfoCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Loop\MiniTracker\Api\Data\TrackingInfoInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function getAll() {
        $collection = $this->trackingInfoCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Loop\MiniTracker\Api\Data\TrackingInfoInterface::class
        );

        $searchResults = $this->searchResultsFactory->create();

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }


}

