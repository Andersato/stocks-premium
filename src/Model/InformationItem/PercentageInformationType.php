<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class PercentageInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): ?string
    {
        if ('-' === $this->value) {
            return null;
        }

        return str_replace('%', '', $this->value);
    }

    public function getType(): string
    {
        return 'float';
    }
}