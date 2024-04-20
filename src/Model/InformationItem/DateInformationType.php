<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class DateInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    final public const BMO = 'BMO';
    final public const AMC = 'AMC';

    public function getValue(): string
    {
        if (str_contains($this->value, self::BMO) || str_contains($this->value, self::AMC)) {
            $date = new \DateTime();
            $this->value = str_replace(' '.self::AMC, ', '.$date->format('Y'), $this->value);
            $this->value = str_replace(' '.self::BMO, ', '.$date->format('Y'), $this->value);
        }

        $date = \DateTime::createFromFormat('M d, Y', $this->value);

        return $date->format('Y-m-d');
    }

    public function getType(): string
    {
        return InformationItemConstants::DATE_TYPE;
    }
}