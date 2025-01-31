<?php

declare(strict_types=1);


namespace App\Response\InformationStock\List;

use App\Response\AppResponseInterface;

final class GetHeadersInformationStockResponse implements AppResponseInterface
{
    private string $label;
    private string $key;
    private bool $sortable;


    public static function create(string $label, string $key, bool $sortable): self
    {
        $response = new self();

        $response->setLabel($label);
        $response->setKey($key);
        $response->setSortable($sortable);

        return $response;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    private function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    private function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    private function setSortable(bool $order): void
    {
        $this->sortable = $order;
    }



}