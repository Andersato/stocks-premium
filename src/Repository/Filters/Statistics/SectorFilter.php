<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class SectorFilter extends TermFilter
{
    final public const FIELD = 'sector';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}