<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class DateInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    final public const BMO = 'BMO';
    final public const AMC = 'AMC';

    public function getValue(): ?string
    {
        if ('-' === $this->value) {
            return null;
        }

        $currentDate = new \DateTime();
        if (str_contains($this->value, self::BMO) || str_contains($this->value, self::AMC)) {
            $this->value = str_replace(' '.self::AMC, ', '.$currentDate->format('Y'), $this->value);
            $this->value = str_replace(' '.self::BMO, ', '.$currentDate->format('Y'), $this->value);
        }

        if(!str_contains($this->value, ',')) {
            $this->value .= ', '.$currentDate->format('Y');
        }

        $date = \DateTime::createFromFormat('M d, Y', $this->value);

        return $date->format('Y-m-d');
    }

    public function getType(): string
    {
        return 'date';
    }
}