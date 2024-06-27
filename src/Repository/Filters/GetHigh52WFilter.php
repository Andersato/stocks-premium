<?php

declare(strict_types=1);


namespace App\Repository\Filters;

use App\Constant\FiltersConstants;
use Doctrine\ORM\QueryBuilder;

final class GetHigh52WFilter
{
    public static function get(QueryBuilder $queryBuilder, string $filter): void
    {
        $queryBuilder->addOrderBy('informationStock.high52W', 'DESC');
        switch ($filter) {
            case FiltersConstants::RANGE_52W_MORE_THAN_10:
                $queryBuilder->andWhere('informationStock.high52W > 10');
                break;
            case FiltersConstants::RANGE_52W_BETWEEN_5_TO_10:
                $queryBuilder->andWhere('informationStock.high52W > 5 and informationStock.high52W <= 10');
                break;
            case FiltersConstants::RANGE_52W_BETWEEN_0_TO_5:
                $queryBuilder->andWhere('informationStock.high52W > 0 and informationStock.high52W <= 5');
                break;
            case FiltersConstants::RANGE_52W_BETWEEN_0_TO_MINUS_5:
                $queryBuilder->andWhere('informationStock.high52W > -5 and informationStock.high52W <= 0');
                break;
            case FiltersConstants::RANGE_52W_BETWEEN_MINUS_5_TO_MINUS_10:
                $queryBuilder->andWhere('informationStock.high52W > -10 and informationStock.high52W <= -5');
                break;
            case FiltersConstants::RANGE_52W_BETWEEN_MINUS_10_TO_MINUS_15:
                $queryBuilder->andWhere('informationStock.high52W > -15 and informationStock.high52W <= -10');
                break;
            case FiltersConstants::RANGE_52W_BETWEEN_LESS_MINUS_15:
                $queryBuilder->andWhere('informationStock.high52W < -15');
                break;
        }
    }
}