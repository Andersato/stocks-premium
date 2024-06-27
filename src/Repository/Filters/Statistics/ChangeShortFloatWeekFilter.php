<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class ChangeShortFloatWeekFilter extends RangeFilter
{
    final public const FIELD = 'changeShortFloatWeek';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}