<?php

declare(strict_types=1);


namespace App\Repository\Filters\Aggregations;

use App\Constant\ElasticsearchConstants;
use App\Model\InformationStock\ParamsElasticSearch;

final class GetAggregations
{
    public static function get(array $aggregations): array
    {
        $response = [];

        foreach ($aggregations as $aggregation) {
            $response[] = match ($aggregation) {
                ElasticsearchConstants::AGGS_SECTOR => [
                    'name' => ElasticsearchConstants::AGGS_SECTOR,
                    'type' => ParamsElasticSearch::TERMS,
                    'field' => ElasticsearchConstants::FIELD_SECTOR,
                    'options' => [ParamsElasticSearch::SIZE => 50]
                ],
                ElasticsearchConstants::AGGS_INDUSTRY => [
                    'name' => ElasticsearchConstants::AGGS_INDUSTRY,
                    'type' => ParamsElasticSearch::TERMS,
                    'field' => ElasticsearchConstants::FIELD_INDUSTRY,
                    'options' => [ParamsElasticSearch::SIZE => 50]
                ],
                ElasticsearchConstants::AGGS_MARKETCAP_RANGES => [
                    'name' => ElasticsearchConstants::AGGS_MARKETCAP_RANGES,
                    'type' => ParamsElasticSearch::RANGE,
                    'field' => ElasticsearchConstants::FIELD_MARKET_CAP,
                    'options' => [ParamsElasticSearch::RANGES => [
                        [
                            ParamsElasticSearch::TO => ElasticsearchConstants::AGGS_RANGE_300
                        ],
                        [
                            ParamsElasticSearch::FROM => ElasticsearchConstants::AGGS_RANGE_300,
                            ParamsElasticSearch::TO => ElasticsearchConstants::AGGS_RANGE_1000
                        ],
                        [
                            ParamsElasticSearch::FROM => ElasticsearchConstants::AGGS_RANGE_1000,
                            ParamsElasticSearch::TO => ElasticsearchConstants::AGGS_RANGE_10000
                        ],
                        [
                            ParamsElasticSearch::FROM => ElasticsearchConstants::AGGS_RANGE_10000,
                            ParamsElasticSearch::TO => ElasticsearchConstants::AGGS_RANGE_200000
                        ],
                        [
                            ParamsElasticSearch::FROM => ElasticsearchConstants::AGGS_RANGE_200000
                        ]
                    ]]
                ],
                default => [],
            };
        }

        return $response;
    }
}