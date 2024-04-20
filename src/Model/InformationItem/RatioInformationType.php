<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class RatioInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): string
    {
        return $this->value;
    }

    public function getType(): string
    {
        return InformationItemConstants::RATIO_TYPE;
    }
}