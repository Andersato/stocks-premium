<?php

declare(strict_types=1);


namespace App\Response\Screener;

use App\Response\AppResponseInterface;

final class GetSelectorFilterResponse implements AppResponseInterface
{
    private string $label;
    private string $value;

    public static function create(string $label, string $value): self
    {
        $response = new self();

        $response->label = $label;
        $response->value = $value;

        return $response;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}