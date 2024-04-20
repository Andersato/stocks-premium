<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class PercentageInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): string
    {
        return str_replace('%', '', $this->value);
    }

    public function getType(): string
    {
        return InformationItemConstants::PERCENTAGE_TYPE;
    }
}