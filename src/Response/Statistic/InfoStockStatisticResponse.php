<?php

declare(strict_types=1);


namespace App\Response\Statistic;

final class InfoStockStatisticResponse
{
    private string $ticker;
    private string $name;
    private string $sector;
    private string $industry;
    private float $changeInsiderOwnWeek;
    private float $changeInstOwnWeek;
    private float $changeShortFloatWeek;
    private float $changeVolume;
    private float $changeRelativeVolume;
    private float $epsQQ;
    private float $epsYYTtm;
    private float $salesYYTtm;
    private float $salesQQ;
    private float $price;
    private float $rsi;
    private float $high52W;
    private float $perfWeek;
    private float $perfQuarter;
    private float $perfMonth;
    private float $perfYear;
    private float $perfYtd;
    private float $perfHalfYear;
    private float $marketCap;
    private float $roe;
    private float $roi;
    private float $roa;

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function setTicker(string $ticker): void
    {
        $this->ticker = $ticker;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSector(): string
    {
        return $this->sector;
    }

    public function setSector(string $sector): void
    {
        $this->sector = $sector;
    }

    public function getIndustry(): string
    {
        return $this->industry;
    }

    public function setIndustry(string $industry): void
    {
        $this->industry = $industry;
    }

    public function getChangeInsiderOwnWeek(): float
    {
        return $this->changeInsiderOwnWeek;
    }

    public function setChangeInsiderOwnWeek(float $changeInsiderOwnWeek): void
    {
        $this->changeInsiderOwnWeek = $changeInsiderOwnWeek;
    }

    public function getChangeInstOwnWeek(): float
    {
        return $this->changeInstOwnWeek;
    }

    public function setChangeInstOwnWeek(float $changeInstOwnWeek): void
    {
        $this->changeInstOwnWeek = $changeInstOwnWeek;
    }

    public function getChangeShortFloatWeek(): float
    {
        return $this->changeShortFloatWeek;
    }

    public function setChangeShortFloatWeek(float $changeShortFloatWeek): void
    {
        $this->changeShortFloatWeek = $changeShortFloatWeek;
    }

    public function getChangeVolume(): float
    {
        return $this->changeVolume;
    }

    public function setChangeVolume(float $changeVolume): void
    {
        $this->changeVolume = $changeVolume;
    }

    public function getChangeRelativeVolume(): float
    {
        return $this->changeRelativeVolume;
    }

    public function setChangeRelativeVolume(float $changeRelativeVolume): void
    {
        $this->changeRelativeVolume = $changeRelativeVolume;
    }

    public function getEpsQQ(): float
    {
        return $this->epsQQ;
    }

    public function setEpsQQ(float $epsQQ): void
    {
        $this->epsQQ = $epsQQ;
    }

    public function getEpsYYTtm(): float
    {
        return $this->epsYYTtm;
    }

    public function setEpsYYTtm(float $epsYYTtm): void
    {
        $this->epsYYTtm = $epsYYTtm;
    }

    public function getSalesYYTtm(): float
    {
        return $this->salesYYTtm;
    }

    public function setSalesYYTtm(float $salesYYTtm): void
    {
        $this->salesYYTtm = $salesYYTtm;
    }

    public function getSalesQQ(): float
    {
        return $this->salesQQ;
    }

    public function setSalesQQ(float $salesQQ): void
    {
        $this->salesQQ = $salesQQ;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getRsi(): float
    {
        return $this->rsi;
    }

    public function setRsi(float $rsi): void
    {
        $this->rsi = $rsi;
    }

    public function getHigh52W(): float
    {
        return $this->high52W;
    }

    public function setHigh52W(float $high52W): void
    {
        $this->high52W = $high52W;
    }

    public function getPerfWeek(): float
    {
        return $this->perfWeek;
    }

    public function setPerfWeek(float $perfWeek): void
    {
        $this->perfWeek = $perfWeek;
    }

    public function getPerfQuarter(): float
    {
        return $this->perfQuarter;
    }

    public function setPerfQuarter(float $perfQuarter): void
    {
        $this->perfQuarter = $perfQuarter;
    }

    public function getPerfMonth(): float
    {
        return $this->perfMonth;
    }

    public function setPerfMonth(float $perfMonth): void
    {
        $this->perfMonth = $perfMonth;
    }

    public function getPerfYear(): float
    {
        return $this->perfYear;
    }

    public function setPerfYear(float $perfYear): void
    {
        $this->perfYear = $perfYear;
    }

    public function getPerfYtd(): float
    {
        return $this->perfYtd;
    }

    public function setPerfYtd(float $perfYtd): void
    {
        $this->perfYtd = $perfYtd;
    }

    public function getPerfHalfYear(): float
    {
        return $this->perfHalfYear;
    }

    public function setPerfHalfYear(float $perfHalfYear): void
    {
        $this->perfHalfYear = $perfHalfYear;
    }

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }

    public function setMarketCap(float $marketCap): void
    {
        $this->marketCap = $marketCap;
    }

    public function getRoe(): float
    {
        return $this->roe;
    }

    public function setRoe(float $roe): void
    {
        $this->roe = $roe;
    }

    public function getRoi(): float
    {
        return $this->roi;
    }

    public function setRoi(float $roi): void
    {
        $this->roi = $roi;
    }

    public function getRoa(): float
    {
        return $this->roa;
    }

    public function setRoa(float $roa): void
    {
        $this->roa = $roa;
    }
}