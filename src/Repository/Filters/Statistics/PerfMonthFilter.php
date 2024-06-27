<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PerfMonthFilter extends RangeFilter
{
    final public const FIELD = 'perfMonth';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}