<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class StringInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    public function getValue(): string
    {
        return $this->value;
    }

    public function getType(): string
    {
        return InformationItemConstants::STRING_TYPE;
    }
}