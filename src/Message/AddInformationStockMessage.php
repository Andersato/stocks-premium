<?php

namespace App\Message;

final class AddInformationStockMessage
{
    private string $ticker;
    private string $name;

    public function __construct(string $ticker, string $name)
    {
        $this->ticker = $ticker;
        $this->name = $name;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getName(): string
    {
        return $this->name;
    }

}