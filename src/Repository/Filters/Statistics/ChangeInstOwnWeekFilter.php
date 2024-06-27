<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class ChangeInstOwnWeekFilter extends RangeFilter
{
    final public const FIELD = 'changeInstOwnWeek';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}