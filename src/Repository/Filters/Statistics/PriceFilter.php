<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PriceFilter extends RangeFilter
{
    final public const FIELD = 'price';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}