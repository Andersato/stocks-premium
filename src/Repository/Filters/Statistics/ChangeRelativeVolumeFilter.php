<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class ChangeRelativeVolumeFilter extends RangeFilter
{
    final public const FIELD = 'changeRelativeVolume';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}