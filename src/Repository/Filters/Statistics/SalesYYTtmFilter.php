<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class SalesYYTtmFilter extends RangeFilter
{
    final public const FIELD = 'salesYYTtm';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}