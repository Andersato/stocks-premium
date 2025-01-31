<?php

declare(strict_types=1);


namespace App\Response\Shared;

use App\Response\AppResponseInterface;
use App\Response\ObjectResponseInterface;

final class KeyObjectPairResponse implements AppResponseInterface
{
    private string $label;
    private ObjectResponseInterface $info;

    public static function create(string $label, ObjectResponseInterface $info): self
    {
        $keyObject = new self();

        $keyObject->label = $label;
        $keyObject->info = $info;

        return $keyObject;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getInfo(): ObjectResponseInterface
    {
        return $this->info;
    }
}