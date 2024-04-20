<?php

namespace App\Model\InformationItem;

trait InformationItemTrait
{
    private string $name;
    private string $value;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->value = '';
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }
}