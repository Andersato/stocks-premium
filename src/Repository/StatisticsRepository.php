<?php

declare(strict_types=1);


namespace App\Repository;

use App\Constant\ElasticsearchConstants;
use App\Model\InformationStock\ParamsElasticSearch;
use App\Model\InformationStock\QueryBuilder;
use App\Repository\Filters\Statistics\StatisticFilter;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

final class StatisticsRepository implements StatisticsRepositoryInterface
{
    private Client $client;

    /**
     * @throws AuthenticationException
     */
    public function __construct(
        readonly string $elasticsearchHost
    )
    {
        $this->client = ClientBuilder::create()->setHosts([$elasticsearchHost])->build();
    }

    /**
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function searchByFilters(StatisticFilter $filters): array
    {
        $queries = $filters->getQueriesToElastic();

        $query = new QueryBuilder();

        $query->bool(ParamsElasticSearch::MUST, $queries);
        $query->sort(ElasticsearchConstants::FIELD_PERF_YEAR, ParamsElasticSearch::DESC);
        $query->size(0);

        $aggregationSource = $query->buildAggregation(ParamsElasticSearch::TOP_DOCS, ParamsElasticSearch::TOP_HITS,
            array_merge(
                [ParamsElasticSearch::SORT => [ElasticsearchConstants::FIELD_PERF_YEAR => [ParamsElasticSearch::ORDER => ParamsElasticSearch::DESC]]],
                [ParamsElasticSearch::SIZE => 50], [ParamsElasticSearch::SOURCE => [
                ElasticsearchConstants::FIELD_SECTOR, ElasticsearchConstants::FIELD_INDUSTRY, ElasticsearchConstants::FIELD_TICKER, ElasticsearchConstants::FIELD_PRICE, ElasticsearchConstants::FIELD_NAME,
                ElasticsearchConstants::FIELD_RSI, ElasticsearchConstants::FIELD_MARKET_CAP, ElasticsearchConstants::FIELD_CHANGE_VOLUME, ElasticsearchConstants::FIELD_CHANGE_RELATIVE_VOLUME,
                ElasticsearchConstants::FIELD_HIGH_52W, ElasticsearchConstants::FIELD_CHANGE_INSIDER_OWN_WEEK, ElasticsearchConstants::FIELD_CHANGE_INST_OWN_WEEK, ElasticsearchConstants::FIELD_CHANGE_SHORT_FLOAT_WEEK,
                ElasticsearchConstants::FIELD_PERF_QUARTER, ElasticsearchConstants::FIELD_PERF_WEEK, ElasticsearchConstants::FIELD_PERF_MONTH, ElasticsearchConstants::FIELD_PERF_YTD, ElasticsearchConstants::FIELD_PERF_HALF_YEAR, ElasticsearchConstants::FIELD_PERF_YEAR,
                ElasticsearchConstants::FIELD_EPS_YY_TTM, ElasticsearchConstants::FIELD_EPS_QQ, ElasticsearchConstants::FIELD_SALES_YY_TTM, ElasticsearchConstants::FIELD_SALES_QQ,
                ElasticsearchConstants::FIELD_ROE, ElasticsearchConstants::FIELD_ROI, ElasticsearchConstants::FIELD_ROA
                ]]
            )
        );

        $aggregationIndustry = $query->buildAggregation(ElasticsearchConstants::AGGS_INDUSTRY, ParamsElasticSearch::TERMS,
            array_merge(
                [ParamsElasticSearch::SIZE => 50], [ParamsElasticSearch::FIELD => ElasticsearchConstants::FIELD_INDUSTRY]
            ),
            $aggregationSource
        );

        $aggregationSector = $query->buildAggregation(ElasticsearchConstants::AGGS_SECTOR, ParamsElasticSearch::TERMS,
            array_merge(
                [ParamsElasticSearch::SIZE => 50], [ParamsElasticSearch::FIELD => ElasticsearchConstants::FIELD_SECTOR]
            ),
            $aggregationIndustry
        );

        $aggregationRanges = $query->buildAggregation(ElasticsearchConstants::AGGS_MARKETCAP_RANGES, ParamsElasticSearch::RANGE,
            array_merge(
                [ParamsElasticSearch::FIELD => ElasticsearchConstants::FIELD_MARKET_CAP],
                [ParamsElasticSearch::RANGES => [
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
            ]]),
           $aggregationSector
        );

        $query->addAggregation($aggregationRanges);


        $params = [
            'index' => ElasticsearchConstants::INDEX_NAME,
            'body' => $query->build()
        ];

        return $this->client->search($params)->asArray();
    }

    /**
     * @throws ServerResponseException
     * @throws ClientResponseException
     */
    public function findAggregationsToFilters(StatisticFilter $filters): array
    {
        $queries = $filters->getQueriesToElastic();

        $query = new QueryBuilder();

        $query->bool(ParamsElasticSearch::MUST, $queries);
        $query->size(0);

        $query->aggregation(ElasticsearchConstants::AGGS_MIN_EPS_QQ, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_EPS_QQ);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_EPS_QQ, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_EPS_QQ);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_EPS_YY_TTM, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_EPS_YY_TTM);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_EPS_YY_TTM, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_EPS_YY_TTM);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_SALES_QQ, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_SALES_QQ);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_SALES_QQ, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_SALES_QQ);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_SALES_YY_TTM, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_SALES_YY_TTM);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_SALES_YY_TTM, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_SALES_YY_TTM);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PRICE, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PRICE);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PRICE, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PRICE);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PERF_HALF_YEAR, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PERF_HALF_YEAR);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PERF_HALF_YEAR, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PERF_HALF_YEAR);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PERF_YEAR, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PERF_YEAR);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PERF_YEAR, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PERF_YEAR);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PERF_YTD, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PERF_YTD);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PERF_YTD, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PERF_YTD);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PERF_MONTH, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PERF_MONTH);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PERF_MONTH, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PERF_MONTH);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PERF_WEEK, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PERF_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PERF_WEEK, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PERF_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_PERF_QUARTER, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_PERF_QUARTER);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_PERF_QUARTER, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_PERF_QUARTER);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_CHANGE_SHORT_OWN_WEEK, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_CHANGE_SHORT_FLOAT_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_CHANGE_SHORT_OWN_WEEK, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_CHANGE_SHORT_FLOAT_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_CHANGE_INST_OWN_WEEK, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_CHANGE_INST_OWN_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_CHANGE_INST_OWN_WEEK, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_CHANGE_INST_OWN_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_CHANGE_INSIDER_OWN_WEEK, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_CHANGE_INSIDER_OWN_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_CHANGE_INSIDER_OWN_WEEK, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_CHANGE_INSIDER_OWN_WEEK);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_HIGH_52W, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_HIGH_52W);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_HIGH_52W, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_HIGH_52W);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_RSI, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_RSI);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_RSI, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_RSI);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_ROE, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_ROE);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_ROE, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_ROE);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_ROI, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_ROI);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_ROI, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_ROI);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_ROA, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_ROA);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_ROA, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_ROA);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_CHANGE_VOLUME, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_CHANGE_VOLUME);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_CHANGE_VOLUME, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_CHANGE_VOLUME);
        $query->aggregation(ElasticsearchConstants::AGGS_MIN_CHANGE_RELATIVE_VOLUME, ParamsElasticSearch::MIN, ElasticsearchConstants::FIELD_CHANGE_RELATIVE_VOLUME);
        $query->aggregation(ElasticsearchConstants::AGGS_MAX_CHANGE_RELATIVE_VOLUME, ParamsElasticSearch::MAX, ElasticsearchConstants::FIELD_CHANGE_RELATIVE_VOLUME);
        $query->aggregation(ElasticsearchConstants::AGGS_SECTOR, ParamsElasticSearch::TERMS, ElasticsearchConstants::FIELD_SECTOR, [ParamsElasticSearch::SIZE => 50]);

        if (!empty($filters->getSector())) {
            $query->aggregationIntoAggregation(ElasticsearchConstants::AGGS_SECTOR, ElasticsearchConstants::AGGS_INDUSTRY, ParamsElasticSearch::TERMS, ElasticsearchConstants::FIELD_INDUSTRY, [ParamsElasticSearch::SIZE => 50]);
        }

        $params = [
            'index' => ElasticsearchConstants::INDEX_NAME,
            'body' => $query->build()
        ];

        $response = $this->client->search($params)->asArray();

        return $response['aggregations'];
    }
}