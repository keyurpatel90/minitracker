<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Observer\Frontend\Checkout;

use Loop\MiniTracker\Model\Logger\Logger;
use Loop\MiniTracker\Model\Request\RequestInfo;
use Loop\MiniTracker\Model\Request\RequestInfoFactory;
use Magento\Framework\MessageQueue\PublisherInterface;
use Loop\MiniTracker\Helper\Data as Helper;
use Magento\Checkout\Model\Session as CheckoutSession;

class CartAddProductComplete implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * @var RequestInfoInterface
     */
    protected $requestInfo;
    /**
     * @var Helper
     */
    protected $data;
    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    public function __construct(
        Logger $logger,
        PublisherInterface $publisher,
        RequestInfoFactory $requestInfo,
        Helper $data,
        CheckoutSession $checkoutSession
    ){
        $this->logger = $logger;
        $this->publisher = $publisher;
        $this->requestInfo = $requestInfo;
        $this->data = $data;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {

        try{
            if($this->data->isEnabled()) {
                /** @var \Magento\Catalog\Model\Product $product */
                $product = $observer->getEvent()->getData("product");
                $quoteId = $this->checkoutSession->getQuoteId();
                $skuExist = $this->data->checkSkuExist($quoteId, $product->getSku());
                if (is_null($skuExist)) {
                    /** @var RequestInfo $requestInfo */
                    $requestInfo = $this->requestInfo->create();
                    $requestInfo->setSku((string)$product->getSku());
                    $requestInfo->setPrice((float)$product->getPrice());
                    $requestInfo->setQuoteId((int)$quoteId);
                    $this->publisher->publish("tracking.request", $requestInfo);
                    $this->logger->info("Request for sku " . $product->getSku() . " is added to queue");
                }
            }
        }catch (Exception $ex){
            $this->logger->critical("Exception while adding product to cart event ".$ex->getMessage());
            throwException(new \RuntimeException($ex->getMessage()));
        }
    }
}

