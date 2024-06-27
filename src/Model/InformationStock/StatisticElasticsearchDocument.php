<?php

declare(strict_types=1);


namespace App\Model\InformationStock;

final class StatisticElasticsearchDocument
{
    private ?string $id;
    private string $ticker;
    private string $name;
    private float $price;
    private string $sector;
    private string $industry;
    private float $changeVolume;
    private float $changeRelativeVolume;
    private float $changeInstOwn;
    private float $changeInsiderOwn;
    private float $changePrice;
    private float $changeShortFloat;
    private float $perfWeek;
    private float $perfMonth;
    private float $perfQuarter;
    private float $perfHalfYear;
    private float $perfYear;
    private float $perfYtd;
    private float $marketCap;
    private float $high52W;
    private float $epsYYTtm;
    private float $epsQQ;
    private float $salesYYTtm;
    private float $salesQQ;

    public function __construct(
        string $ticker, string $name, float $price, string $sector, string $industry, float $changeVolume,
        float $changeRelativeVolume, float $changeInstOwn, float $changeInsiderOwn, float $changePrice, float $changeShortFloat,
        float $perfWeek, float $perfMonth, float $perfYear, float $perfQuarter, float $perfHalfYear, float $perfYtd, float $marketCap,
        float $high52W = null, ?float $epsQQ = null, ?float $epsYYTtm = null, ?float $salesYYTtm = null, ?float $salesQQ = null,
        ?string $id = null,
    )
    {
        $this->id = $id;
        $this->ticker = $ticker;
        $this->name = $name;
        $this->price = $price;
        $this->sector = $sector;
        $this->industry = $industry;
        $this->changeVolume = $changeVolume;
        $this->changeRelativeVolume = $changeRelativeVolume;
        $this->changeInstOwn = $changeInstOwn;
        $this->changeInsiderOwn = $changeInsiderOwn;
        $this->changePrice = $changePrice;
        $this->changeShortFloat = $changeShortFloat;
        $this->perfMonth = $perfMonth;
        $this->perfWeek = $perfWeek;
        $this->perfYear = $perfYear;
        $this->perfQuarter = $perfQuarter;
        $this->perfHalfYear = $perfHalfYear;
        $this->perfYtd = $perfYtd;
        $this->marketCap = $marketCap;
        $this->high52W = $high52W;
        $this->epsYYTtm = $epsYYTtm;
        $this->epsQQ = $epsQQ;
        $this->salesYYTtm = $salesYYTtm;
        $this->salesQQ = $salesQQ;

        return $this;
    }

    public static function transform(array $data): ?self
    {
        if (isset($data['hits']['total']['value']) && 0 < $data['hits']['total']['value']) {
            $id = $data['hits']['hits'][0]['_id'];
            $source = $data['hits']['hits'][0]['_source'];

            return new self(
                ticker: $source['ticker'],
                name: $source['name'],
                price: $source['price'],
                sector: $source['sector'],
                industry: $source['industry'],
                changeVolume: $source['changeVolume'],
                changeRelativeVolume: $source['changeRelativeVolume'],
                changeInstOwn: $source['changeInstOwn'],
                changeInsiderOwn: $source['changeInsiderOwn'],
                changePrice: $source['changePrice'],
                changeShortFloat: $source['changeShortFloat'],
                perfWeek: $source['perfWeek'],
                perfMonth: $source['perfMonth'],
                perfYear: $source['perfYear'],
                perfQuarter: $source['perfQuarter'],
                perfHalfYear: $source['perfHalfYear'],
                perfYtd: $source['perfYtd'],
                marketCap: $source['marketCap'],
                high52W: $source['high52W'],
                epsQQ: $source['epsQQ'],
                epsYYTtm: $source['epsYYTtm'],
                salesYYTtm: $source['salesYYTtm'],
                salesQQ: $source['salesQQ'],
                id: $id
            );
        }

        return null;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSector(): string
    {
        return $this->sector;
    }

    public function getIndustry(): string
    {
        return $this->industry;
    }

    public function getChangeVolume(): float
    {
        return $this->changeVolume;
    }

    public function getChangeRelativeVolume(): float
    {
        return $this->changeRelativeVolume;
    }

    public function getChangeInstOwn(): float
    {
        return $this->changeInstOwn;
    }

    public function getChangeInsiderOwn(): float
    {
        return $this->changeInsiderOwn;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setTicker(string $ticker): void
    {
        $this->ticker = $ticker;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSector(string $sector): void
    {
        $this->sector = $sector;
    }

    public function setIndustry(string $industry): void
    {
        $this->industry = $industry;
    }

    public function setChangeVolume(float $changeVolume): void
    {
        $this->changeVolume = $changeVolume;
    }

    public function setChangeRelativeVolume(float $changeRelativeVolume): void
    {
        $this->changeRelativeVolume = $changeRelativeVolume;
    }

    public function setChangeInstOwn(float $changeInstOwn): void
    {
        $this->changeInstOwn = $changeInstOwn;
    }

    public function setChangeInsiderOwn(float $changeInsiderOwn): void
    {
        $this->changeInsiderOwn = $changeInsiderOwn;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getChangePrice(): float
    {
        return $this->changePrice;
    }

    public function setChangePrice(float $changePrice): void
    {
        $this->changePrice = $changePrice;
    }

    public function getChangeShortFloat(): float
    {
        return $this->changeShortFloat;
    }

    public function setChangeShortFloat(float $changeShortFloat): void
    {
        $this->changeShortFloat = $changeShortFloat;
    }

    public function getPerfWeek(): float
    {
        return $this->perfWeek;
    }

    public function setPerfWeek(float $perfWeek): void
    {
        $this->perfWeek = $perfWeek;
    }

    public function getPerfMonth(): float
    {
        return $this->perfMonth;
    }

    public function setPerfMonth(float $perfMonth): void
    {
        $this->perfMonth = $perfMonth;
    }

    public function getPerfQuarter(): float
    {
        return $this->perfQuarter;
    }

    public function setPerfQuarter(float $perfQuarter): void
    {
        $this->perfQuarter = $perfQuarter;
    }

    public function getPerfHalfYear(): float
    {
        return $this->perfHalfYear;
    }

    public function setPerfHalfYear(float $perfHalfYear): void
    {
        $this->perfHalfYear = $perfHalfYear;
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

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }

    public function setMarketCap(float $marketCap): void
    {
        $this->marketCap = $marketCap;
    }

    public function getHigh52W(): float
    {
        return $this->high52W;
    }

    public function setHigh52W(float $high52W): void
    {
        $this->high52W = $high52W;
    }

    public function getEpsYYTtm(): float
    {
        return $this->epsYYTtm;
    }

    public function setEpsYYTtm(float $epsYYTtm): void
    {
        $this->epsYYTtm = $epsYYTtm;
    }

    public function getEpsQQ(): float
    {
        return $this->epsQQ;
    }

    public function setEpsQQ(float $epsQQ): void
    {
        $this->epsQQ = $epsQQ;
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
}