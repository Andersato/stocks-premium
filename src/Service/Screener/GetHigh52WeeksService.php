<?php

declare(strict_types=1);


namespace App\Service\Screener;

use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Repository\StockRepository;
use App\Response\AppResponseInterface;
use App\Response\Screener\GetSelectorFilterResponse;

final readonly class GetHigh52WeeksService
{
    public function __invoke(): array
    {
        $high52Weeks = [
            FiltersConstants::RANGE_52W_MORE_THAN_10,
            FiltersConstants::RANGE_52W_BETWEEN_5_TO_10,
            FiltersConstants::RANGE_52W_BETWEEN_0_TO_5,
            FiltersConstants::RANGE_52W_BETWEEN_0_TO_MINUS_5,
            FiltersConstants::RANGE_52W_BETWEEN_MINUS_5_TO_MINUS_10,
            FiltersConstants::RANGE_52W_BETWEEN_MINUS_10_TO_MINUS_15,
            FiltersConstants::RANGE_52W_BETWEEN_LESS_MINUS_15,
        ];

        $response = [];
        foreach ($high52Weeks as $high52Week) {
            $response[] = GetSelectorFilterResponse::create(
                label: $high52Week,
                value: $high52Week
            );
        }

        return $response;
    }
}