<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Model\Request;

use Loop\MiniTracker\Api\Data\RequestInfoInterface;

/**
 * Class RequestInfo prototype
 */
class RequestInfo implements RequestInfoInterface
{
    /**
     * @var string
     */
    private $sku;
    /**
     * @var float
     */
    private $price;

    /**
     * @var int
     */
    private $quoteId;

    /**
     * @inheritDoc
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @inheritDoc
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price)
    {
       $this->price = $price;
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): float
    {
       return $this->price;
    }

    /**
     * @inheritDoc
     */
    public function setQuoteId($quoteId)
    {
        $this->quoteId = $quoteId;
    }

    /**
     * @inheritDoc
     */
    public function getQuoteId(): int
    {
        return $this->quoteId;
    }
}