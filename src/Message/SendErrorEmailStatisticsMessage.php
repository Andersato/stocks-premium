<?php

namespace App\Message;

final class SendErrorEmailStatisticsMessage
{
    private string $stock;
    private string $itemName;
    private string $itemValue;
    private string $error;

    public function __construct(string $stock, string $itemName, string $itemValue, string $error)
    {
        $this->stock = $stock;
        $this->itemName = $itemName;
        $this->itemValue = $itemValue;
        $this->error = $error;
    }

    public function getStock(): string
    {
        return $this->stock;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }

    public function getItemValue(): string
    {
        return $this->itemValue;
    }

    public function getError(): string
    {
        return $this->error;
    }
}