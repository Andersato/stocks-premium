<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class ChangeInsiderOwnWeekFilter extends RangeFilter
{
    final public const FIELD = 'changeInsiderOwnWeek';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}