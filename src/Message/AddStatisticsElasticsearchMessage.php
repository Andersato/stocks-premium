<?php

namespace App\Message;

final class AddStatisticsElasticsearchMessage
{
    private string $ticker;

    public function __construct(string $ticker)
    {
        $this->ticker = $ticker;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }
}