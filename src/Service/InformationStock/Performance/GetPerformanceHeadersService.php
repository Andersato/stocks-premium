<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Performance;

use App\Repository\StockRepository;
use App\Response\InformationStock\Performance\GetPerformanceResponse;
use App\Response\Shared\KeyValuePairResponse;
use App\Utils\Utils;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class GetPerformanceHeadersService
{
    public function __construct(
        private StockRepository $stockRepository,
        private TranslatorInterface $translator
    )
    {
    }

    public function __invoke(): GetPerformanceResponse
    {
        $performanceCategories = [];
        $marketCapCategories = [];
        $sectors = [];

        $performanceCategoriesTitles = ['topGainers', 'topLosers'];
        foreach ($performanceCategoriesTitles as $item) {
            $key = sprintf('performance.titles.%s', $item);
            $performanceCategories[] = new KeyValuePairResponse(
                label: $this->translator->trans($key, [], 'screener'),
                value: $this->translator->trans($key, [], 'screener', 'en'),
            );
        }

        $marketCapCategoriesTitles = [
            'smallCaps',
            'midCaps',
            'largeCaps',
            'megaCaps'
        ];
        foreach ($marketCapCategoriesTitles as $item) {
            $key = sprintf('performance.titles.%s', $item);
            $marketCapCategories[] = new KeyValuePairResponse(
                label: $this->translator->trans($key, [], 'screener'),
                value: $this->translator->trans($key, [], 'screener', 'en'),
            );
        }

        $sectorsTitles = $this->stockRepository->findSectors();
        foreach ($sectorsTitles as $item) {
            $key = sprintf('sectors.%s', Utils::translateEnglishToSpanishValue($item['sector']));
            $sectors[] = new KeyValuePairResponse(
                label: $this->translator->trans($key, [], 'screener'),
                value: $this->translator->trans($key, [], 'screener', 'en'),
            );
        }

        return new GetPerformanceResponse(
            performanceCategories: $performanceCategories,
            marketCapCategories: $marketCapCategories,
            sectors: $sectors
        );
    }
}