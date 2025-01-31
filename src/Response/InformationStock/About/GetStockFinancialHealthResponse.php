<?php

declare(strict_types=1);


namespace App\Response\InformationStock\About;

use App\Response\AppResponseInterface;
use App\Response\ObjectResponseInterface;

final class GetStockFinancialHealthResponse implements AppResponseInterface, ObjectResponseInterface
{
    private ?float $quickRatio = null;

    private ?float $currentRatio = null;

    private ?float $bookSh = null;

    private ?float $cashSh = null;

    private ?float $debtEquity = null;

    private ?float $ltDebtEquity = null;


    public static function create(?float $quickRatio, ?float $currentRatio, ?float $bookSh, ?float $cashSh, ?float $debtEquity, ?float $ltDebtEquity): self
    {
        $financialHealth = new self();

        $financialHealth->quickRatio = $quickRatio;
        $financialHealth->currentRatio = $currentRatio;
        $financialHealth->bookSh = $bookSh;
        $financialHealth->cashSh = $cashSh;
        $financialHealth->debtEquity = $debtEquity;
        $financialHealth->ltDebtEquity = $ltDebtEquity;

        return $financialHealth;
    }

    public function getQuickRatio(): ?float
    {
        return $this->quickRatio;
    }

    public function getCurrentRatio(): ?float
    {
        return $this->currentRatio;
    }

    public function getBookSh(): ?float
    {
        return $this->bookSh;
    }

    public function getCashSh(): ?float
    {
        return $this->cashSh;
    }

    public function getDebtEquity(): ?float
    {
        return $this->debtEquity;
    }

    public function getLtDebtEquity(): ?float
    {
        return $this->ltDebtEquity;
    }
}