<?php

declare(strict_types=1);


namespace App\Response\InformationStock\About;

use App\Response\AppResponseInterface;
use App\Response\ObjectResponseInterface;

final class GetStockIncomeStatementResponse implements AppResponseInterface, ObjectResponseInterface
{
    private ?string $income = null;
    private ?string $sales = null;
    private ?float $epsTtm = null;
    private ?string $epsYYTtm = null;
    private ?string $salesYYTtm = null;
    private ?string $epsQQ = null;
    private ?string $salesQQ = null;

    public static function create(
        ?string $income,
        ?string $sales,
        ?float $epsTtm,
        ?string $epsYYTtm,
        ?string $salesYYTtm,
        ?string $epsQQ,
        ?string $salesQQ
    ): self
    {
        $incomeStatement = new self();

        $incomeStatement->income = $income;
        $incomeStatement->sales = $sales;
        $incomeStatement->epsTtm = $epsTtm;
        $incomeStatement->epsYYTtm = $epsYYTtm;
        $incomeStatement->salesYYTtm = $salesYYTtm;
        $incomeStatement->epsQQ = $epsQQ;
        $incomeStatement->salesQQ = $salesQQ;

        return $incomeStatement;
    }

    public function getIncome(): ?string
    {
        return $this->income;
    }

    public function getSales(): ?string
    {
        return $this->sales;
    }

    public function getEpsTtm(): ?float
    {
        return $this->epsTtm;
    }

    public function getEpsYYTtm(): ?string
    {
        return $this->epsYYTtm;
    }

    public function getSalesYYTtm(): ?string
    {
        return $this->salesYYTtm;
    }

    public function getEpsQQ(): ?string
    {
        return $this->epsQQ;
    }

    public function getSalesQQ(): ?string
    {
        return $this->salesQQ;
    }
}