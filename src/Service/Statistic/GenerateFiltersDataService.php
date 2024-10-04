<?php

declare(strict_types=1);


namespace App\Service\Statistic;

use App\Constant\ElasticsearchConstants;
use App\Model\InformationStock\ParamsElasticSearch;
use App\Repository\Filters\Statistics\StatisticFilter;
use App\Repository\StatisticsRepositoryInterface;
use App\Response\Statistic\InfoIndustryStatisticResponse;
use App\Response\Statistic\InfoMarketCapStatisticResponse;
use App\Response\Statistic\InfoSectorStatisticResponse;
use App\Response\Statistic\InfoStatisticResponse;
use App\Response\Statistic\InfoStockStatisticResponse;
use Symfony\Component\Serializer\SerializerInterface;

final class GenerateFiltersDataService
{
    private StatisticsRepositoryInterface $statisticsRepository;
    private SerializerInterface $serializer;

    public function __construct(StatisticsRepositoryInterface $statisticsRepository, SerializerInterface $serializer)
    {
        $this->statisticsRepository = $statisticsRepository;
        $this->serializer = $serializer;
    }

    public function __invoke(StatisticFilter $statisticFilter): InfoStatisticResponse
    {
        $response = $this->statisticsRepository->searchByFilters($statisticFilter);

        $infoStatisticResponse = new InfoStatisticResponse();

        if (isset($response[ParamsElasticSearch::AGGREGATIONS][ElasticsearchConstants::AGGS_MARKETCAP_RANGES][ParamsElasticSearch::BUCKETS])) {
            foreach ($response[ParamsElasticSearch::AGGREGATIONS][ElasticsearchConstants::AGGS_MARKETCAP_RANGES][ParamsElasticSearch::BUCKETS] as $marketCap) {
                if (isset($marketCap[ElasticsearchConstants::AGGS_SECTOR][ParamsElasticSearch::BUCKETS])) {
                    $marketCapResponse = new InfoMarketCapStatisticResponse();
                    $nameMarketCap = '';
                    if (isset($marketCap[ParamsElasticSearch::FROM])) {
                        $marketCapResponse->setFrom((int)$marketCap[ParamsElasticSearch::FROM]);
                        $nameMarketCap .= (int)$marketCap[ParamsElasticSearch::FROM];
                    }
                    if (isset($marketCap[ParamsElasticSearch::TO])) {
                        $marketCapResponse->setTo((int)$marketCap[ParamsElasticSearch::TO]);
                        $nameMarketCap .= (int)$marketCap[ParamsElasticSearch::TO];
                    }
                    $marketCapResponse->setName($nameMarketCap);
                    $marketCapResponse->setCount($marketCap[ParamsElasticSearch::DOC_COUNT]);
                    foreach ($marketCap[ElasticsearchConstants::AGGS_SECTOR][ParamsElasticSearch::BUCKETS] as $sector) {
                        if (isset($sector[ElasticsearchConstants::AGGS_INDUSTRY][ParamsElasticSearch::BUCKETS])) {
                            $sectorResponse = new InfoSectorStatisticResponse($sector[ParamsElasticSearch::KEY]);
                            foreach ($sector[ElasticsearchConstants::AGGS_INDUSTRY][ParamsElasticSearch::BUCKETS] as $industry) {
                                $industryResponse = new InfoIndustryStatisticResponse($industry[ParamsElasticSearch::KEY]);
                                if (isset($industry[ParamsElasticSearch::TOP_DOCS][ParamsElasticSearch::HITS][ParamsElasticSearch::HITS])) {
                                    foreach ($industry[ParamsElasticSearch::TOP_DOCS][ParamsElasticSearch::HITS][ParamsElasticSearch::HITS] as $stock) {
                                        $jsonData = json_encode($stock[ParamsElasticSearch::SOURCE]);
                                        /** @var InfoStockStatisticResponse $infoStock */
                                        $infoStock = $this->serializer->deserialize($jsonData, InfoStockStatisticResponse::class, 'json');
                                        $industryResponse->addStock($infoStock);
                                    }
                                }
                                $sectorResponse->addIndustries($industryResponse);
                            }
                            $marketCapResponse->addSector($sectorResponse);
                        }
                    }
                    $infoStatisticResponse->addMarketCap($marketCapResponse);
                }
            }
        }

        return $infoStatisticResponse;
    }
}