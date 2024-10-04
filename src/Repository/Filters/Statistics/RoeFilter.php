<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class RoeFilter extends RangeFilter
{
    final public const FIELD = 'roe';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}