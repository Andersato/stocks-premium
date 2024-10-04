<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class RoiFilter extends RangeFilter
{
    final public const FIELD = 'roi';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}