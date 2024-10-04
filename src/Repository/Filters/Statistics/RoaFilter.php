<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class RoaFilter extends RangeFilter
{
    final public const FIELD = 'roa';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}