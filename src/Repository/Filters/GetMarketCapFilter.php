<?php

declare(strict_types=1);


namespace App\Repository\Filters;

use App\Constant\FiltersConstants;
use Doctrine\ORM\QueryBuilder;

final class GetMarketCapFilter
{
    public static function get(QueryBuilder $queryBuilder, string $filter): void
    {
        switch ($filter) {
            case FiltersConstants::MARKET_CAP_LESS_THAN:
                $queryBuilder->andWhere('informationStock.marketCap <= 300');
                break;
            case FiltersConstants::MARKET_CAP_BETWEEN_300_TO_1000:
                $queryBuilder->andWhere('informationStock.marketCap > 300 and informationStock.marketCap <= 1000');
                break;
            case FiltersConstants::MARKET_CAP_BETWEEN_1000_TO_10000:
                $queryBuilder->andWhere('informationStock.marketCap > 1000 and informationStock.marketCap <= 10000');
                break;
            case FiltersConstants::MARKET_CAP_BETWEEN_10000_TO_200000:
                $queryBuilder->andWhere('informationStock.marketCap > 10000 and informationStock.marketCap <= 200000');
                break;
            case FiltersConstants::MARKET_CAP_MORE_THAN_200000:
                $queryBuilder->andWhere('informationStock.marketCap > 200000');
                break;
        }
    }
}