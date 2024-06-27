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

final class StatisticsRepository implements StatisticsRepositoryInterface
{
    private Client $client;

    /**
     * @throws AuthenticationException
     */
    public function __construct(
        private readonly string $elasticsearchHost
    )
    {
        $this->client = ClientBuilder::create()->setHosts([$elasticsearchHost])->build();
    }

    public function searchByFilters(StatisticFilter $filters): void
    {

    }

    public function findAggregationsToFilters(StatisticFilter $filters)
    {
        $queries[] = $filters->getQueriesToElastic();

        $query = new QueryBuilder();

        $query->bool(ParamsElasticSearch::MUST, $queries);

        $params = [
            'index' => ElasticsearchConstants::INDEX_NAME,
            'body' => [
                'query' => [
                    'term' => [
                        'ticker' => $message->getTicker()
                    ]
                ]
            ]
        ];
    }
}