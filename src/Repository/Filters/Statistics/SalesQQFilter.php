<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class SalesQQFilter extends RangeFilter
{
    final public const FIELD = 'salesQQ';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}