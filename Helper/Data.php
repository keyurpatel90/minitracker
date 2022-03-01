<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Helper;

use Loop\MiniTracker\Model\ResourceModel\TrackingInfo\CollectionFactory as TrackingInfoFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;


class Data extends AbstractHelper
{
    CONST ENABLE = "minitracker_section/general/enable";
    CONST TRACKING_HOST = "minitracker_section/general/tracking_host";
    CONST TIMEOUT = "minitracker_section/general/timeout";
    /**
     * @var CacheInterface
     */
    protected $_cache;
    /**
     * @var string
     */
    protected $_cacheIdPrefix = 'MINITRACK';

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var TrackingInfoFactory
     */
    private $trackingInfoFactory;

    /**
     * @var array
     */
    protected $_cacheTags = [];

    /**
     * @var int|bool|null
     */
    protected $_cacheLifetime = null;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        TrackingInfoFactory $trackingInfoFactory,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        CacheInterface $cache,
        SerializerInterface $serializer = null
    ) {
        $this->serializer = $serializer;
        $this->trackingInfoFactory = $trackingInfoFactory;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->_cache = $cache;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        $storeId = $this->storeManager->getStore()->getId();
        return $this->scopeConfig->getValue(self::ENABLE,ScopeInterface::SCOPE_STORE,$storeId);
    }

    /**
     * @return string|null
     */
    public function getTrackingHost()
    {
        $storeId = $this->storeManager->getStore()->getId();
        return $this->scopeConfig->getValue(self::TRACKING_HOST,ScopeInterface::SCOPE_STORE,$storeId);
    }
    /**
     * @return int|null
     */
    public function getCurlTimeout()
    {
        $storeId = $this->storeManager->getStore()->getId();
        return $this->scopeConfig->getValue(self::TIMEOUT,ScopeInterface::SCOPE_STORE,$storeId);
    }

    /**
     * @param $quoteId
     * @param $sku
     * @return array|null
     */
    public function checkSkuExist($quoteId,$sku){
        // check if data exist in cache
        $cacheId = $this->getCacheId($quoteId,$sku);
        $result = $this->_cache->load($cacheId);
        if($result){
            return $this->serializer->unserialize($result);
        } else{
            /** @var Loop\MiniTracker\Model\ResourceModel\TrackingInfo\Collection $resultCollection */
            $resultCollection = $this->trackingInfoFactory->create()
                    ->addFieldToFilter("sku",["eq"=> $sku])
                    ->addFieldToFilter("quote_id",["eq"=> $quoteId])
                    ->load()
                    ->getFirstItem();

            if($resultCollection->getSize()){
                $data = $this->serializer->serialize($resultCollection->getData());
                $this->_cache->save($data,$this->getCacheId($quoteId,$sku),$this->_cacheTags,$this->_cacheLifetime);
                return $resultCollection->getData();
            }else{
                return null;
            }
        }
    }

    /**
     * @param $quoteId
     * @param $sku
     * @return string
     */
    public function getCacheId($quoteId,$sku){
        return $this->_cacheIdPrefix."-".$quoteId."-".$sku;
    }
}

