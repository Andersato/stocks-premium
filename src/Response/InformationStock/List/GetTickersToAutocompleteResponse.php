<?php

declare(strict_types=1);


namespace App\Response\InformationStock\List;

use App\Response\AppResponseInterface;

final class GetTickersToAutocompleteResponse implements AppResponseInterface
{
    private string $ticker;
    private string $name;

    public static function create(string $ticker, string $name): self
    {
        $response = new self();

        $response->ticker = $ticker;
        $response->name = $name;

        return $response;
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