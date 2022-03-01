<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Loop\MiniTracker\Api\Data;

interface RequestInfoInterface{

    /**
     * Set sku
     * @param string $sku
     * @return void
     */
    public function setSku($sku);

    /**
     *  Get sku value
     * @return string|null
     */
    public function getSku(): string;

    /**
     * Set sku
     * @param float $price
     * @return void
     */
    public function setPrice($price);

    /**
     *  Get sku value
     * @return float
     */
    public function getPrice(): float;

    /**
     * Set Quote ID
     * @param int $quoteId
     * @return void
     */
    public function setQuoteId($quoteId);

    /**
     *  Get Quote ID value
     * @return int
     */
    public function getQuoteId(): int;
}