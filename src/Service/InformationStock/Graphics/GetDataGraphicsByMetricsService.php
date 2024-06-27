<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Graphics;

use App\Dto\InformationStock\GetInformationStockMetricsDto;
use App\Entity\InformationStock;
use Doctrine\ORM\EntityManagerInterface;

final class GetDataGraphicsByMetricsService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(GetInformationStockMetricsDto $informationStockMetricsDto): array
    {
        $metrics = $this->entityManager->getRepository(InformationStock::class)->findDataByMetrics(
            ticker: $informationStockMetricsDto->getTicker(),
            metrics: $informationStockMetricsDto->getMetrics()
        );

        $response = [];
        foreach ($metrics as $metric) {
            $metricResponse['createdAt'] = $metric['createdAt'];
            foreach ($informationStockMetricsDto->getMetrics() as $metricDto) {
                $metricResponse[$metricDto] = $metric[$metricDto];
            }
            $response[] = $metricResponse;
        }

        return $response;
    }
}