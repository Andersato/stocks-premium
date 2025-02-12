<?php

declare(strict_types=1);


namespace App\Service\InformationStock\ExtraData;

use App\Entity\InformationStock;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CalculateExtraDataService
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function __invoke(string $ticker): void
    {
        $informationStocks = $this->entityManager->getRepository(InformationStock::class)->findByAllInformationStockToExtraData(
            ticker: $ticker,
        );

        $movingAverages10 = $this->getMovingAverages(
            informationStocks: $informationStocks,
            period: 10
        );

        $movingAverages20 = $this->getMovingAverages(
            informationStocks: $informationStocks,
            period: 20
        );

        $movingAverages50 = $this->getMovingAverages(
            informationStocks: $informationStocks,
            period: 50
        );

        foreach ($informationStocks as $index => $informationStock) {
            $informationStock->setMa10(round($movingAverages10[$index], 2));
            $informationStock->setMa20(round($movingAverages20[$index], 2));
            $informationStock->setMa50(round($movingAverages50[$index], 2));
            $this->entityManager->persist($informationStock);
        }

        $this->entityManager->flush();
    }

    /**
     * @param InformationStock[] $informationStocks
     * @param int $period
     * @return array
     */
    private function getMovingAverages(array $informationStocks, int $period): array
    {
        $sum = [];
        $movingAveragesResponse = [];
        $this->getMainSumToInitialPeriod(
            data: $informationStocks,
            sum: $sum,
            movingAveragesResponse: $movingAveragesResponse,
            period: $period
        );

        $totalItems = count($informationStocks);
        for ($i = $period - 1; $i < $totalItems; $i++) {
            $sum[] = $informationStocks[$i]->getPrice();
            $movingAveragesResponse[] = $this->calculateMovingAverages(
                sum: $sum,
                period: $period
            );
            array_splice($sum, 0, 1);
        }

        return $movingAveragesResponse;
    }

    /**
     * @param InformationStock[] $data
     * @param float[] $sum
     * @param float[] $movingAveragesResponse
     * @param int $period
     * @return void
     */
    private function getMainSumToInitialPeriod(array $data, array &$sum, array &$movingAveragesResponse,  int $period): void
    {
        $sum = [];
        $movingAveragesResponse = [];
        for ($i = 0; $i < $period-1; $i++) {
            $sum[] = $data[$i]->getPrice();
            $movingAveragesResponse[] = $this->calculateMovingAverages(
                sum: $sum,
                period: $i + 1
            );
        }
    }

    private function calculateMovingAverages(array $sum, int $period): float
    {
        return array_sum($sum) / $period;
    }
}