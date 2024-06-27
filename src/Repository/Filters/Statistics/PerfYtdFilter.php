<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PerfYtdFilter extends RangeFilter
{
    final public const FIELD = 'perfYtd';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}