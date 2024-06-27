<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PerfHalfYearFilter extends RangeFilter
{
    final public const FIELD = 'perfHalfYear';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}