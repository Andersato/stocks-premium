<?php

declare(strict_types=1);


namespace App\Response\Statistic;

final class InfoStatisticResponse
{
    /** @var InfoMarketCapStatisticResponse[]  */
    private array $marketCaps;

    public function getMarketCaps(): array
    {
        return $this->marketCaps;
    }

    public function addMarketCap(InfoMarketCapStatisticResponse $infoMarketCapStatisticResponse): void
    {
        $this->marketCaps[] = $infoMarketCapStatisticResponse;
    }

}