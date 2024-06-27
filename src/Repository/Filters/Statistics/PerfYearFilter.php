<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PerfYearFilter extends RangeFilter
{
    final public const FIELD = 'perfYear';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}