<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class RangeInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): string
    {
        return $this->value;
    }

    public function getType(): string
    {
        return InformationItemConstants::RANGE_TYPE;
    }
}