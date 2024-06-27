<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class EpsQQFilter extends RangeFilter
{
    final public const FIELD = 'epsQQ';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}