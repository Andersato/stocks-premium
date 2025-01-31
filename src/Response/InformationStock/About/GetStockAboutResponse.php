<?php

declare(strict_types=1);


namespace App\Response\InformationStock\About;

use App\Response\AppResponseInterface;
use App\Response\Shared\KeyObjectPairResponse;

final class GetStockAboutResponse implements AppResponseInterface
{
    private string $companyName;
    private KeyObjectPairResponse $profile;
    private KeyObjectPairResponse $financialHealth;
    private KeyObjectPairResponse $incomeStatement;
    private KeyObjectPairResponse $profitability;
    private KeyObjectPairResponse $valuation;

    public static function create(
        string $companyName,
        KeyObjectPairResponse $profile,
        KeyObjectPairResponse $financialHealth,
        KeyObjectPairResponse $incomeStatement,
        KeyObjectPairResponse $profitability,
        KeyObjectPairResponse $valuation
    ): self
    {
        $about = new self();

        $about->companyName = $companyName;
        $about->profile = $profile;
        $about->financialHealth = $financialHealth;
        $about->incomeStatement = $incomeStatement;
        $about->profitability = $profitability;
        $about->valuation = $valuation;

        return $about;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getProfile(): KeyObjectPairResponse
    {
        return $this->profile;
    }

    public function getFinancialHealth(): KeyObjectPairResponse
    {
        return $this->financialHealth;
    }

    public function getIncomeStatement(): KeyObjectPairResponse
    {
        return $this->incomeStatement;
    }

    public function getProfitability(): KeyObjectPairResponse
    {
        return $this->profitability;
    }

    public function getValuation(): KeyObjectPairResponse
    {
        return $this->valuation;
    }
}