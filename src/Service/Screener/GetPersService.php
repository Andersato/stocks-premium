<?php

declare(strict_types=1);


namespace App\Service\Screener;

use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Repository\StockRepository;
use App\Response\AppResponseInterface;
use App\Response\Screener\GetSelectorFilterResponse;

final readonly class GetPersService
{
    public function __invoke(): array
    {
        $pers = [
            FiltersConstants::PER_LESS_THAN_0,
            FiltersConstants::PER_BETWEEN_0_TO_15,
            FiltersConstants::PER_BETWEEN_15_TO_30,
            FiltersConstants::PER_MOTE_THAN_30,
        ];

        $response = [];
        foreach ($pers as $per) {
            $response[] = GetSelectorFilterResponse::create(
                label: $per,
                value: $per
            );
        }

        return $response;
    }
}