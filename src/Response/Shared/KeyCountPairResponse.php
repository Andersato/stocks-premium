<?php

declare(strict_types=1);


namespace App\Response\Shared;

use App\Response\AppResponseInterface;

final class KeyCountPairResponse implements AppResponseInterface
{
    private string $key;
    private int $count;

    public function __construct(string $key, int $count)
    {
        $this->key = $key;
        $this->count = $count;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}