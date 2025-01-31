<?php

declare(strict_types=1);


namespace App\Response\Statistic;

use App\Model\InformationStock\ParamsElasticSearch;
use App\Response\Shared\KeyCountPairResponse;

final class GetAggregationTransform
{
    public static function transform(array $result): GetAggregationsResponse
    {
        $responseAggregations = [];

        foreach ($result as $key => $item) {
            $responseAggregations[$key] = [];

            if (isset($item[ParamsElasticSearch::BUCKETS])) {
                foreach ($item[ParamsElasticSearch::BUCKETS] as $bucket) {
                    $responseAggregations[$key][] = new KeyCountPairResponse(
                        key: $bucket['key'],
                        count: $bucket['doc_count']
                    );
                }
            }
        }

        return new GetAggregationsResponse(aggregations: $responseAggregations);
    }
}