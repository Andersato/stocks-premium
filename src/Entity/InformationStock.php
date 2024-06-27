<?php

namespace App\Entity;

use App\Repository\InformationStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationStockRepository::class)]
#[ORM\Index(name: "information_stock_created_at_idx", columns: ["created_at"])]
#[ORM\Index(name: "information_stock_market_cap_idx", columns: ["market_cap"])]
class InformationStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne]
    private ?Stock $stock = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $indexName = null;

    #[ORM\Column(nullable: true)]
    private ?float $marketCap = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $optionShort = null;

    #[ORM\Column(nullable: true)]
    private ?float $salesSurprise = null;

    #[ORM\Column(nullable: true)]
    private ?float $sma20 = null;

    #[ORM\Column(nullable: true)]
    private ?float $sma50 = null;

    #[ORM\Column(nullable: true)]
    private ?float $sma200 = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsSurprise = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsThisYear = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsPast5Year = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsNextGYear = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsNext5Year = null;

    #[ORM\Column(nullable: true)]
    private ?float $salesPast5Year = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsYYTtm = null;

    #[ORM\Column(nullable: true)]
    private ?float $salesYYTtm = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsQQ = null;

    #[ORM\Column(nullable: true)]
    private ?float $salesQQ = null;

    #[ORM\Column(nullable: true)]
    private ?float $insiderOwn = null;

    #[ORM\Column(nullable: true)]
    private ?float $insiderTrans = null;

    #[ORM\Column(nullable: true)]
    private ?float $instOwn = null;

    #[ORM\Column(nullable: true)]
    private ?float $instTrans = null;

    #[ORM\Column(nullable: true)]
    private ?float $roa = null;

    #[ORM\Column(nullable: true)]
    private ?float $roe = null;

    #[ORM\Column(nullable: true)]
    private ?float $roi = null;

    #[ORM\Column(nullable: true)]
    private ?float $grossMargin = null;

    #[ORM\Column(nullable: true)]
    private ?float $operMargin = null;

    #[ORM\Column(nullable: true)]
    private ?float $profitMargin = null;

    #[ORM\Column(nullable: true)]
    private ?float $payout = null;

    #[ORM\Column(nullable: true)]
    private ?float $shortFloat = null;

    #[ORM\Column(nullable: true)]
    private ?float $high52W = null;

    #[ORM\Column(nullable: true)]
    private ?float $low52W = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfWeek = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfMonth = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfQuarter = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfHalfYear = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfYear = null;

    #[ORM\Column(nullable: true)]
    private ?float $perfYtd = null;

    #[ORM\Column(nullable: true)]
    private ?float $changeToday = null;

    #[ORM\Column(nullable: true)]
    private ?float $income = null;

    #[ORM\Column(nullable: true)]
    private ?float $sales = null;

    #[ORM\Column(nullable: true)]
    private ?float $shsOutstand = null;

    #[ORM\Column(nullable: true)]
    private ?float $shsFloat = null;

    #[ORM\Column(nullable: true)]
    private ?float $shortInterest = null;

    #[ORM\Column(nullable: true)]
    private ?float $avgVolume = null;

    #[ORM\Column(nullable: true)]
    private ?float $bookSh = null;

    #[ORM\Column(nullable: true)]
    private ?float $cashSh = null;

    #[ORM\Column(nullable: true)]
    private ?float $per = null;

    #[ORM\Column(nullable: true)]
    private ?float $forwardPer = null;

    #[ORM\Column(nullable: true)]
    private ?float $peg = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceSales = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceBook = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceCash = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceFreeCashFlow = null;

    #[ORM\Column(nullable: true)]
    private ?float $quickRatio = null;

    #[ORM\Column(nullable: true)]
    private ?float $currentRatio = null;

    #[ORM\Column(nullable: true)]
    private ?float $debtEquity = null;

    #[ORM\Column(nullable: true)]
    private ?float $ltDebtEquity = null;

    #[ORM\Column(nullable: true)]
    private ?float $shortRatio = null;

    #[ORM\Column(nullable: true)]
    private ?float $rsi14 = null;

    #[ORM\Column(nullable: true)]
    private ?float $recom = null;

    #[ORM\Column(nullable: true)]
    private ?float $relVolume = null;

    #[ORM\Column(nullable: true)]
    private ?float $beta = null;

    #[ORM\Column(nullable: true)]
    private ?float $atr14 = null;

    #[ORM\Column(nullable: true)]
    private ?float $dividendEst = null;

    #[ORM\Column(nullable: true)]
    private ?float $dividendTtm = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsTtm = null;

    #[ORM\Column(nullable: true)]
    private ?float $epsNextYear = null;

    #[ORM\Column]
    private ?float $epsNextQuarter = null;

    #[ORM\Column(nullable: true)]
    private ?float $targetPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $prevClose = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dividendExDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $earnings = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $range52W = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $volatility = null;

    #[ORM\Column(nullable: true)]
    private ?float $volume = null;

    #[ORM\Column(nullable: true)]
    private ?int $employees = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceOpen = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceHigh = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceLow = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): void
    {
        $this->stock = $stock;
    }

    public function getIndexName(): ?string
    {
        return $this->indexName;
    }

    public function setIndexName(?string $indexName): static
    {
        $this->indexName = $indexName;

        return $this;
    }

    public function getMarketCap(): ?float
    {
        return $this->marketCap;
    }

    public function setMarketCap(?float $marketCap): static
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    public function getOptionShort(): ?string
    {
        return $this->optionShort;
    }

    public function setOptionShort(?string $optionShort): static
    {
        $this->optionShort = $optionShort;

        return $this;
    }

    public function getSalesSurprise(): ?float
    {
        return $this->salesSurprise;
    }

    public function setSalesSurprise(?float $salesSurprise): static
    {
        $this->salesSurprise = $salesSurprise;

        return $this;
    }

    public function getSma20(): ?float
    {
        return $this->sma20;
    }

    public function setSma20(?float $sma20): static
    {
        $this->sma20 = $sma20;

        return $this;
    }

    public function getSma50(): ?float
    {
        return $this->sma50;
    }

    public function setSma50(?float $sma50): static
    {
        $this->sma50 = $sma50;

        return $this;
    }

    public function getSma200(): ?float
    {
        return $this->sma200;
    }

    public function setSma200(?float $sma200): static
    {
        $this->sma200 = $sma200;

        return $this;
    }

    public function getEpsSurprise(): ?float
    {
        return $this->epsSurprise;
    }

    public function setEpsSurprise(?float $epsSurprise): static
    {
        $this->epsSurprise = $epsSurprise;

        return $this;
    }

    public function getEpsThisYear(): ?float
    {
        return $this->epsThisYear;
    }

    public function setEpsThisYear(?float $epsThisYear): static
    {
        $this->epsThisYear = $epsThisYear;

        return $this;
    }

    public function getEpsPast5Year(): ?float
    {
        return $this->epsPast5Year;
    }

    public function setEpsPast5Year(?float $epsPast5Year): static
    {
        $this->epsPast5Year = $epsPast5Year;

        return $this;
    }

    public function getEpsNextGYear(): ?float
    {
        return $this->epsNextGYear;
    }

    public function setEpsNextGYear(?float $epsNextGYear): static
    {
        $this->epsNextGYear = $epsNextGYear;

        return $this;
    }

    public function getEpsNext5Year(): ?float
    {
        return $this->epsNext5Year;
    }

    public function setEpsNext5Year(?float $epsNext5Year): static
    {
        $this->epsNext5Year = $epsNext5Year;

        return $this;
    }

    public function getSalesPast5Year(): ?float
    {
        return $this->salesPast5Year;
    }

    public function setSalesPast5Year(?float $salesPast5Year): static
    {
        $this->salesPast5Year = $salesPast5Year;

        return $this;
    }

    public function getEpsYYTtm(): ?float
    {
        return $this->epsYYTtm;
    }

    public function setEpsYYTtm(?float $epsYYTtm): static
    {
        $this->epsYYTtm = $epsYYTtm;

        return $this;
    }

    public function getSalesYYTtm(): ?float
    {
        return $this->salesYYTtm;
    }

    public function setSalesYYTtm(?float $salesYYTtm): static
    {
        $this->salesYYTtm = $salesYYTtm;

        return $this;
    }

    public function getEpsQQ(): ?float
    {
        return $this->epsQQ;
    }

    public function setEpsQQ(?float $epsQQ): static
    {
        $this->epsQQ = $epsQQ;

        return $this;
    }

    public function getSalesQQ(): ?float
    {
        return $this->salesQQ;
    }

    public function setSalesQQ(?float $salesQQ): static
    {
        $this->salesQQ = $salesQQ;

        return $this;
    }

    public function getInsiderOwn(): ?float
    {
        return $this->insiderOwn;
    }

    public function setInsiderOwn(?float $insiderOwn): static
    {
        $this->insiderOwn = $insiderOwn;

        return $this;
    }

    public function getInsiderTrans(): ?float
    {
        return $this->insiderTrans;
    }

    public function setInsiderTrans(?float $insiderTrans): static
    {
        $this->insiderTrans = $insiderTrans;

        return $this;
    }

    public function getInstOwn(): ?float
    {
        return $this->instOwn;
    }

    public function setInstOwn(?float $instOwn): static
    {
        $this->instOwn = $instOwn;

        return $this;
    }

    public function getInstTrans(): ?float
    {
        return $this->instTrans;
    }

    public function setInstTrans(?float $instTrans): static
    {
        $this->instTrans = $instTrans;

        return $this;
    }

    public function getRoa(): ?float
    {
        return $this->roa;
    }

    public function setRoa(?float $roa): static
    {
        $this->roa = $roa;

        return $this;
    }

    public function getRoe(): ?float
    {
        return $this->roe;
    }

    public function setRoe(?float $roe): static
    {
        $this->roe = $roe;

        return $this;
    }

    public function getRoi(): ?float
    {
        return $this->roi;
    }

    public function setRoi(?float $roi): static
    {
        $this->roi = $roi;

        return $this;
    }

    public function getGrossMargin(): ?float
    {
        return $this->grossMargin;
    }

    public function setGrossMargin(?float $grossMargin): static
    {
        $this->grossMargin = $grossMargin;

        return $this;
    }

    public function getOperMargin(): ?float
    {
        return $this->operMargin;
    }

    public function setOperMargin(?float $operMargin): static
    {
        $this->operMargin = $operMargin;

        return $this;
    }

    public function getProfitMargin(): ?float
    {
        return $this->profitMargin;
    }

    public function setProfitMargin(?float $profitMargin): static
    {
        $this->profitMargin = $profitMargin;

        return $this;
    }

    public function getPayout(): ?float
    {
        return $this->payout;
    }

    public function setPayout(?float $payout): static
    {
        $this->payout = $payout;

        return $this;
    }

    public function getShortFloat(): ?float
    {
        return $this->shortFloat;
    }

    public function setShortFloat(?float $shortFloat): static
    {
        $this->shortFloat = $shortFloat;

        return $this;
    }

    public function getHigh52W(): ?float
    {
        return $this->high52W;
    }

    public function setHigh52W(?float $high52W): static
    {
        $this->high52W = $high52W;

        return $this;
    }

    public function getLow52W(): ?float
    {
        return $this->low52W;
    }

    public function setLow52W(?float $low52W): static
    {
        $this->low52W = $low52W;

        return $this;
    }

    public function getPerfWeek(): ?float
    {
        return $this->perfWeek;
    }

    public function setPerfWeek(?float $perfWeek): static
    {
        $this->perfWeek = $perfWeek;

        return $this;
    }

    public function getPerfMonth(): ?float
    {
        return $this->perfMonth;
    }

    public function setPerfMonth(?float $perfMonth): static
    {
        $this->perfMonth = $perfMonth;

        return $this;
    }

    public function getPerfQuarter(): ?float
    {
        return $this->perfQuarter;
    }

    public function setPerfQuarter(?float $perfQuarter): static
    {
        $this->perfQuarter = $perfQuarter;

        return $this;
    }

    public function getPerfHalfYear(): ?float
    {
        return $this->perfHalfYear;
    }

    public function setPerfHalfYear(?float $perfHalfYear): static
    {
        $this->perfHalfYear = $perfHalfYear;

        return $this;
    }

    public function getPerfYear(): ?float
    {
        return $this->perfYear;
    }

    public function setPerfYear(?float $perfYear): static
    {
        $this->perfYear = $perfYear;

        return $this;
    }

    public function getPerfYtd(): ?float
    {
        return $this->perfYtd;
    }

    public function setPerfYtd(?float $perfYtd): static
    {
        $this->perfYtd = $perfYtd;

        return $this;
    }

    public function getChangeToday(): ?float
    {
        return $this->changeToday;
    }

    public function setChangeToday(?float $changeToday): static
    {
        $this->changeToday = $changeToday;

        return $this;
    }

    public function getIncome(): ?float
    {
        return $this->income;
    }

    public function setIncome(?float $income): static
    {
        $this->income = $income;

        return $this;
    }

    public function getSales(): ?float
    {
        return $this->sales;
    }

    public function setSales(?float $sales): static
    {
        $this->sales = $sales;

        return $this;
    }

    public function getShsOutstand(): ?float
    {
        return $this->shsOutstand;
    }

    public function setShsOutstand(?float $shsOutstand): static
    {
        $this->shsOutstand = $shsOutstand;

        return $this;
    }

    public function getShsFloat(): ?float
    {
        return $this->shsFloat;
    }

    public function setShsFloat(?float $shsFloat): static
    {
        $this->shsFloat = $shsFloat;

        return $this;
    }

    public function getShortInterest(): ?float
    {
        return $this->shortInterest;
    }

    public function setShortInterest(?float $shortInterest): static
    {
        $this->shortInterest = $shortInterest;

        return $this;
    }

    public function getAvgVolume(): ?float
    {
        return $this->avgVolume;
    }

    public function setAvgVolume(?float $avgVolume): static
    {
        $this->avgVolume = $avgVolume;

        return $this;
    }

    public function getBookSh(): ?float
    {
        return $this->bookSh;
    }

    public function setBookSh(?float $bookSh): static
    {
        $this->bookSh = $bookSh;

        return $this;
    }

    public function getCashSh(): ?float
    {
        return $this->cashSh;
    }

    public function setCashSh(?float $cashSh): static
    {
        $this->cashSh = $cashSh;

        return $this;
    }

    public function getPer(): ?float
    {
        return $this->per;
    }

    public function setPer(?float $per): static
    {
        $this->per = $per;

        return $this;
    }

    public function getForwardPer(): ?float
    {
        return $this->forwardPer;
    }

    public function setForwardPer(?float $forwardPer): static
    {
        $this->forwardPer = $forwardPer;

        return $this;
    }

    public function getPeg(): ?float
    {
        return $this->peg;
    }

    public function setPeg(?float $peg): static
    {
        $this->peg = $peg;

        return $this;
    }

    public function getPriceSales(): ?float
    {
        return $this->priceSales;
    }

    public function setPriceSales(?float $priceSales): static
    {
        $this->priceSales = $priceSales;

        return $this;
    }

    public function getPriceBook(): ?float
    {
        return $this->priceBook;
    }

    public function setPriceBook(?float $priceBook): static
    {
        $this->priceBook = $priceBook;

        return $this;
    }

    public function getPriceCash(): ?float
    {
        return $this->priceCash;
    }

    public function setPriceCash(?float $priceCash): static
    {
        $this->priceCash = $priceCash;

        return $this;
    }

    public function getPriceFreeCashFlow(): ?float
    {
        return $this->priceFreeCashFlow;
    }

    public function setPriceFreeCashFlow(?float $priceFreeCashFlow): static
    {
        $this->priceFreeCashFlow = $priceFreeCashFlow;

        return $this;
    }

    public function getQuickRatio(): ?float
    {
        return $this->quickRatio;
    }

    public function setQuickRatio(?float $quickRatio): static
    {
        $this->quickRatio = $quickRatio;

        return $this;
    }

    public function getCurrentRatio(): ?float
    {
        return $this->currentRatio;
    }

    public function setCurrentRatio(?float $currentRatio): static
    {
        $this->currentRatio = $currentRatio;

        return $this;
    }

    public function getDebtEquity(): ?float
    {
        return $this->debtEquity;
    }

    public function setDebtEquity(?float $debtEquity): static
    {
        $this->debtEquity = $debtEquity;

        return $this;
    }

    public function getLtDebtEquity(): ?float
    {
        return $this->ltDebtEquity;
    }

    public function setLtDebtEquity(?float $ltDebtEquity): static
    {
        $this->ltDebtEquity = $ltDebtEquity;

        return $this;
    }

    public function getShortRatio(): ?float
    {
        return $this->shortRatio;
    }

    public function setShortRatio(?float $shortRatio): static
    {
        $this->shortRatio = $shortRatio;

        return $this;
    }

    public function getRsi14(): ?float
    {
        return $this->rsi14;
    }

    public function setRsi14(?float $rsi14): static
    {
        $this->rsi14 = $rsi14;

        return $this;
    }

    public function getRecom(): ?float
    {
        return $this->recom;
    }

    public function setRecom(?float $recom): static
    {
        $this->recom = $recom;

        return $this;
    }

    public function getRelVolume(): ?float
    {
        return $this->relVolume;
    }

    public function setRelVolume(?float $relVolume): static
    {
        $this->relVolume = $relVolume;

        return $this;
    }

    public function getBeta(): ?float
    {
        return $this->beta;
    }

    public function setBeta(?float $beta): static
    {
        $this->beta = $beta;

        return $this;
    }

    public function getAtr14(): ?float
    {
        return $this->atr14;
    }

    public function setAtr14(?float $atr14): static
    {
        $this->atr14 = $atr14;

        return $this;
    }

    public function getDividendEst(): ?float
    {
        return $this->dividendEst;
    }

    public function setDividendEst(?float $dividendEst): static
    {
        $this->dividendEst = $dividendEst;

        return $this;
    }

    public function getDividendTtm(): ?float
    {
        return $this->dividendTtm;
    }

    public function setDividendTtm(?float $dividendTtm): static
    {
        $this->dividendTtm = $dividendTtm;

        return $this;
    }

    public function getEpsTtm(): ?float
    {
        return $this->epsTtm;
    }

    public function setEpsTtm(?float $epsTtm): static
    {
        $this->epsTtm = $epsTtm;

        return $this;
    }

    public function getEpsNextYear(): ?float
    {
        return $this->epsNextYear;
    }

    public function setEpsNextYear(?float $epsNextYear): static
    {
        $this->epsNextYear = $epsNextYear;

        return $this;
    }

    public function getEpsNextQuarter(): ?float
    {
        return $this->epsNextQuarter;
    }

    public function setEpsNextQuarter(float $epsNextQuarter): static
    {
        $this->epsNextQuarter = $epsNextQuarter;

        return $this;
    }

    public function getTargetPrice(): ?float
    {
        return $this->targetPrice;
    }

    public function setTargetPrice(?float $targetPrice): static
    {
        $this->targetPrice = $targetPrice;

        return $this;
    }

    public function getPrevClose(): ?float
    {
        return $this->prevClose;
    }

    public function setPrevClose(?float $prevClose): static
    {
        $this->prevClose = $prevClose;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDividendExDate(): ?\DateTimeInterface
    {
        return $this->dividendExDate;
    }

    public function setDividendExDate(?\DateTimeInterface $dividendExDate): static
    {
        $this->dividendExDate = $dividendExDate;

        return $this;
    }

    public function getEarnings(): ?\DateTimeInterface
    {
        return $this->earnings;
    }

    public function setEarnings(?\DateTimeInterface $earnings): static
    {
        $this->earnings = $earnings;

        return $this;
    }

    public function getRange52W(): ?string
    {
        return $this->range52W;
    }

    public function setRange52W(?string $range52W): static
    {
        $this->range52W = $range52W;

        return $this;
    }

    public function getVolatility(): ?string
    {
        return $this->volatility;
    }

    public function setVolatility(?string $volatility): static
    {
        $this->volatility = $volatility;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function setVolume(?float $volume): static
    {
        $this->volume = $volume;

        return $this;
    }

    public function getEmployees(): ?int
    {
        return $this->employees;
    }

    public function setEmployees(?int $employees): static
    {
        $this->employees = $employees;

        return $this;
    }

    public function getPriceOpen(): ?float
    {
        return $this->priceOpen;
    }

    public function setPriceOpen(?float $priceOpen): static
    {
        $this->priceOpen = $priceOpen;

        return $this;
    }

    public function getPriceHigh(): ?float
    {
        return $this->priceHigh;
    }

    public function setPriceHigh(?float $priceHigh): static
    {
        $this->priceHigh = $priceHigh;

        return $this;
    }

    public function getPriceLow(): ?float
    {
        return $this->priceLow;
    }

    public function setPriceLow(?float $priceLow): static
    {
        $this->priceLow = $priceLow;

        return $this;
    }
}
