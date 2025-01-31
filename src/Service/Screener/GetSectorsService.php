<?php

declare(strict_types=1);


namespace App\Service\Screener;

use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Repository\StockRepository;
use App\Response\AppResponseInterface;
use App\Response\Screener\GetSelectorFilterResponse;

final readonly class GetSectorsService
{
    public function __construct(
        private StockRepository $stockRepository
    )
    {
    }

    public function __invoke(): array
    {
        $distinctSectors = $this->stockRepository->findSectors();
        $response = [];
        foreach ($distinctSectors as $sector) {
            $response[] = GetSelectorFilterResponse::create(
                label: $sector['sector'],
                value: $sector['sector']
            );
        }

        return $response;
    }
}