<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class IndustryFilter extends TermFilter
{
    final public const FIELD = 'industry';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}