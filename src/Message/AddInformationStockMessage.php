<?php

namespace App\Message;

final class AddInformationStockMessage
{
    private string $ticker;
    private string $name;
    private int $numMessage;

    public function __construct(string $ticker, string $name, int $numMessage)
    {
        $this->ticker = $ticker;
        $this->name = $name;
        $this->numMessage = $numMessage;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumMessage(): int
    {
        return $this->numMessage;
    }
}