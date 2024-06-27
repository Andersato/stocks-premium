<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Graphics;

use App\Entity\InformationStock;
use App\Response\AppResponseInterface;
use App\Response\InformationStock\GetInformationStockMetricsCollectionResponse;
use App\Response\InformationStock\GetInformationStockMetricsResponse;
use Doctrine\ORM\EntityManagerInterface;

final class GetDataGraphicsByMetricsPriceVolumeService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(string $ticker): AppResponseInterface
    {
        $metrics = $this->entityManager->getRepository(InformationStock::class)->findDataByMetricsPriceAndVolume(
            ticker: $ticker,
        );

        $response = GetInformationStockMetricsCollectionResponse::create();
        foreach ($metrics as $metric) {
            $response->addMetric(
                GetInformationStockMetricsResponse::create(
                    day: $metric['createdAt'],
                    metric: $metric[$informationStockMetricsDto->getMetric()]
                )
            );
        }

        return $response;
    }
}