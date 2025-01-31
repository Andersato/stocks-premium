<?php

declare(strict_types=1);


namespace App\Response\InformationStock\About;

use App\Response\AppResponseInterface;
use App\Response\ObjectResponseInterface;

final class GetStockProfitabilityResponse implements AppResponseInterface, ObjectResponseInterface
{
    private ?string $roa = null;
    private ?string $roe = null;
    private ?string $roi = null;
    private ?string $grossMargin = null;
    private ?string $operMargin = null;
    private ?string $profitMargin = null;

    public static function create(?string $roa, ?string $roe, ?string $roi, ?string $grossMargin, ?string $operMargin, ?string $profitMargin): self
    {
        $profitability = new self();

        $profitability->roa = $roa;
        $profitability->roe = $roe;
        $profitability->roi = $roi;
        $profitability->grossMargin = $grossMargin;
        $profitability->operMargin = $operMargin;
        $profitability->profitMargin = $profitMargin;

        return $profitability;
    }

    public function getRoa(): ?string
    {
        return $this->roa;
    }

    public function getRoe(): ?string
    {
        return $this->roe;
    }

    public function getRoi(): ?string
    {
        return $this->roi;
    }

    public function getGrossMargin(): ?string
    {
        return $this->grossMargin;
    }

    public function getOperMargin(): ?string
    {
        return $this->operMargin;
    }

    public function getProfitMargin(): ?string
    {
        return $this->profitMargin;
    }
}