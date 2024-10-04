<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

use App\Model\InformationStock\ParamsElasticSearch;

abstract class TermFilter implements StatisticFilterInterface
{
    public ?string $text = null;

    public function getText(): ?string
    {
        return $this->text;
    }

    public abstract function getField(): string;

    public function createFilter(): array
    {
        if (empty($this->getText())) {
            return [];
        }

        return [
            ParamsElasticSearch::TERM => [
                $this->getField() => $this->getText()
            ]
        ];
    }
}