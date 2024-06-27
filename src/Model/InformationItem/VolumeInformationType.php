<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class VolumeInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): ?string
    {
        if ('-' === $this->value) {
            return null;
        }

        $this->value = (float)str_replace(",", "", $this->value);

        return (string) $this->value;
    }

    public function getType(): string
    {
        return 'float';
    }
}