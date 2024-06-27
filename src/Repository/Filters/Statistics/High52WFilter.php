<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class High52WFilter extends RangeFilter
{
    final public const FIELD = 'high52W';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}