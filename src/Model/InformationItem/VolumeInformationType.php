<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class VolumeInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): string
    {
        $this->value = (float)str_replace(",", "", $this->value);

        return (string) $this->value;
    }

    public function getType(): string
    {
        return InformationItemConstants::VOLUME_TYPE;
    }
}