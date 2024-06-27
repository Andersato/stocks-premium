<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class EpsYYTtmFilter extends RangeFilter
{
    final public const FIELD = 'epsYYTtm';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}