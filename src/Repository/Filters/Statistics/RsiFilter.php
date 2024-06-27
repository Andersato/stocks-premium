<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class RsiFilter extends RangeFilter
{
    final public const FIELD = 'rsi';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}