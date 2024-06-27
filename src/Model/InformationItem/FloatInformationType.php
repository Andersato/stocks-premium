<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class FloatInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): ?string
    {
        if ('-' === $this->value) {
            return null;
        }

        return $this->value;
    }

    public function getType(): string
    {
        return 'float';
    }
}