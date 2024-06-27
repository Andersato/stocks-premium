<?php

declare(strict_types=1);


namespace App\Repository\Filters;

use App\Constant\FiltersConstants;
use Doctrine\ORM\QueryBuilder;

final class GetPerFilter
{
    public static function get(QueryBuilder $queryBuilder, string $filter): void
    {
        $queryBuilder->addOrderBy('informationStock.per', 'DESC');
        switch ($filter) {
            case FiltersConstants::PER_LESS_THAN_0:
                $queryBuilder->andWhere('informationStock.per < 0');
                break;
            case FiltersConstants::PER_BETWEEN_0_TO_15:
                $queryBuilder->andWhere('informationStock.per >= 0 and informationStock.per <= 15');
                break;
            case FiltersConstants::PER_BETWEEN_15_TO_30:
                $queryBuilder->andWhere('informationStock.per > 15 and informationStock.per <= 30');
                break;
            case FiltersConstants::PER_MOTE_THAN_30:
                $queryBuilder->andWhere('informationStock.per > 30');
                break;
        }
    }
}