<?php

declare(strict_types=1);


namespace App\Service\Screener;

use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Repository\StockRepository;
use App\Response\AppResponseInterface;
use App\Response\Screener\GetSelectorFilterResponse;

final readonly class GetMarketCapsService
{
    public function __invoke(): array
    {
        $marketCaps = [
            FiltersConstants::MARKET_CAP_LESS_THAN,
            FiltersConstants::MARKET_CAP_BETWEEN_300_TO_1000,
            FiltersConstants::MARKET_CAP_BETWEEN_1000_TO_10000,
            FiltersConstants::MARKET_CAP_BETWEEN_10000_TO_200000,
            FiltersConstants::MARKET_CAP_MORE_THAN_200000,
        ];

        $response = [];
        foreach ($marketCaps as $marketCap) {
            $response[] = GetSelectorFilterResponse::create(
                label: $marketCap,
                value: $marketCap
            );
        }

        return $response;
    }
}