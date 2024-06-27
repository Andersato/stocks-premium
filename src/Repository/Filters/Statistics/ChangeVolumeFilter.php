<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class ChangeVolumeFilter extends RangeFilter
{
    final public const FIELD = 'changeVolume';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}