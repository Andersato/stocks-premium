<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class StatisticFilter
{
    public SectorFilter $sector;
    public IndustryFilter $industry;
    public PriceFilter $price;
    public PerfQuarterFilter $perfQuarter;
    public PerfWeekFilter $perfWeek;
    public PerfMonthFilter $perfMonth;
    public PerfHalfYearFilter $perfHalfYear;
    public PerfYearFilter $perfYear;
    public PerfYtdFilter $perfYtd;
    public EpsQQFilter $epsQQ;
    public EpsYYTtmFilter $epsYYTtm;
    public SalesQQFilter $salesQQ;
    public SalesYYTtmFilter $salesYYTtm;
    public High52WFilter $high52W;
    public RsiFilter $rsi;
    public ChangeVolumeFilter $changeVolume;
    public ChangeRelativeVolumeFilter $changeRelativeVolume;
    public ChangeInstOwnWeekFilter $changeInstOwnWeek;
    public ChangeInsiderOwnWeekFilter $changeInsiderOwnWeek;
    public ChangeShortFloatWeekFilter $changeShortFloatWeek;

    public function getSector(): SectorFilter
    {
        return $this->sector;
    }

    public function getIndustry(): IndustryFilter
    {
        return $this->industry;
    }

    public function getPrice(): PriceFilter
    {
        return $this->price;
    }

    public function getPerfQuarter(): PerfQuarterFilter
    {
        return $this->perfQuarter;
    }

    public function getPerfWeek(): PerfWeekFilter
    {
        return $this->perfWeek;
    }

    public function getPerfMonth(): PerfMonthFilter
    {
        return $this->perfMonth;
    }

    public function getPerfHalfYear(): PerfHalfYearFilter
    {
        return $this->perfHalfYear;
    }

    public function getPerfYear(): PerfYearFilter
    {
        return $this->perfYear;
    }

    public function getPerfYtd(): PerfYtdFilter
    {
        return $this->perfYtd;
    }

    public function getEpsQQ(): EpsQQFilter
    {
        return $this->epsQQ;
    }

    public function getEpsYYTtm(): EpsYYTtmFilter
    {
        return $this->epsYYTtm;
    }

    public function getSalesQQ(): SalesQQFilter
    {
        return $this->salesQQ;
    }

    public function getSalesYYTtm(): SalesYYTtmFilter
    {
        return $this->salesYYTtm;
    }

    public function getHigh52W(): High52WFilter
    {
        return $this->high52W;
    }

    public function getRsi(): RsiFilter
    {
        return $this->rsi;
    }

    public function getChangeVolume(): ChangeVolumeFilter
    {
        return $this->changeVolume;
    }

    public function getChangeRelativeVolume(): ChangeRelativeVolumeFilter
    {
        return $this->changeRelativeVolume;
    }

    public function getChangeInstOwnWeek(): ChangeInstOwnWeekFilter
    {
        return $this->changeInstOwnWeek;
    }

    public function getChangeInsiderOwnWeek(): ChangeInsiderOwnWeekFilter
    {
        return $this->changeInsiderOwnWeek;
    }

    public function getChangeShortFloatWeek(): ChangeShortFloatWeekFilter
    {
        return $this->changeShortFloatWeek;
    }

    public function getQueriesToElastic(): array
    {
        $queries = [];
        if ([] !== $this->getSector()->createFilter()) {
            $queries[] = $this->getSector()->createFilter();
        }
        if ([] !== $this->getIndustry()->createFilter()) {
            $queries[] = $this->getIndustry()->createFilter();
        }
        if ([] !== $this->getPrice()->createFilter()) {
            $queries[] = $this->getPrice()->createFilter();
        }
        if ([] !== $this->getRsi()->createFilter()) {
            $queries[] = $this->getRsi()->createFilter();
        }
        if ([] !== $this->getSalesQQ()->createFilter()) {
            $queries[] = $this->getSalesQQ()->createFilter();
        }
        if ([] !== $this->getSalesYYTtm()->createFilter()) {
            $queries[] = $this->getSalesYYTtm()->createFilter();
        }
        if ([] !== $this->getEpsQQ()->createFilter()) {
            $queries[] = $this->getEpsQQ()->createFilter();
        }
        if ([] !== $this->getHigh52W()->createFilter()) {
            $queries[] = $this->getHigh52W()->createFilter();
        }
        if ([] !== $this->getPerfYtd()->createFilter()) {
            $queries[] = $this->getPerfYtd()->createFilter();
        }
        if ([] !== $this->getPerfHalfYear()->createFilter()) {
            $queries[] = $this->getPerfHalfYear()->createFilter();
        }
        if ([] !== $this->getPerfQuarter()->createFilter()) {
            $queries[] = $this->getPerfQuarter()->createFilter();
        }
        if ([] !== $this->getPerfYear()->createFilter()) {
            $queries[] = $this->getPerfYear()->createFilter();
        }
        if ([] !== $this->getPerfYtd()->createFilter()) {
            $queries[] = $this->getPerfYtd()->createFilter();
        }
        if ([] !== $this->getPerfMonth()->createFilter()) {
            $queries[] = $this->getPerfMonth()->createFilter();
        }
        if ([] !== $this->getPerfWeek()->createFilter()) {
            $queries[] = $this->getPerfWeek()->createFilter();
        }
        if ([] !== $this->getChangeInsiderOwnWeek()->createFilter()) {
            $queries[] = $this->getChangeInsiderOwnWeek()->createFilter();
        }
        if ([] !== $this->getChangeRelativeVolume()->createFilter()) {
            $queries[] = $this->getChangeRelativeVolume()->createFilter();
        }
        if ([] !== $this->getChangeInstOwnWeek()->createFilter()) {
            $queries[] = $this->getChangeInstOwnWeek()->createFilter();
        }
        if ([] !== $this->getChangeShortFloatWeek()->createFilter()) {
            $queries[] = $this->getChangeShortFloatWeek()->createFilter();
        }
        if ([] !== $this->getChangeVolume()->createFilter()) {
            $queries[] = $this->getChangeVolume()->createFilter();
        }
        if ([] !== $this->getEpsYYTtm()->createFilter()) {
            $queries[] = $this->getEpsYYTtm()->createFilter();
        }

        return $queries;
    }
}