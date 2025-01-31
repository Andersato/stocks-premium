<?php

declare(strict_types=1);


namespace App\Response\InformationStock\About;

use App\Response\AppResponseInterface;
use App\Response\ObjectResponseInterface;

final class GetStockValuationResponse implements AppResponseInterface, ObjectResponseInterface
{
    private ?float $per = null;
    private ?float $forwardPer = null;

    private ?float $peg = null;

    private ?float $priceSales = null;

    private ?float $priceBook = null;

    private ?float $priceFreeCashFlow = null;

    public static function create(?float $per, ?float $forwardPer, ?float $peg, ?float $priceSales, ?float $priceBook, ?float $priceFreeCashFlow): self
    {
        $valuation = new self();
        
        $valuation->per = $per;
        $valuation->forwardPer = $forwardPer;
        $valuation->peg = $peg;
        $valuation->priceSales = $priceSales;
        $valuation->priceBook = $priceBook;
        $valuation->priceFreeCashFlow = $priceFreeCashFlow;
        
        return $valuation;
    }

    public function getPer(): ?float
    {
        return $this->per;
    }

    public function getForwardPer(): ?float
    {
        return $this->forwardPer;
    }

    public function getPeg(): ?float
    {
        return $this->peg;
    }

    public function getPriceSales(): ?float
    {
        return $this->priceSales;
    }

    public function getPriceBook(): ?float
    {
        return $this->priceBook;
    }

    public function getPriceFreeCashFlow(): ?float
    {
        return $this->priceFreeCashFlow;
    }
}