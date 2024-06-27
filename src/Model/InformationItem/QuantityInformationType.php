<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class QuantityInformationType implements InformationTypeInterface
{
    use InformationItemTrait;

    final public const BILLON = 'B';
    final public const MILLON = 'M';
    final public const THOUSANDS = 'K';


    public function getValue(): ?string
    {
        if ('-' === $this->value) {
            return null;
        }

        preg_match('/([\d.]+)([A-Z]?)/', $this->value, $matches);

        $number = $matches[1];
        $letter = $matches[2];

        $this->value = match ($letter) {
            self::BILLON => $number * 1000,
            self::MILLON => $number * 1,
            self::THOUSANDS => $number / 1000,
            default => '',
        };

        return (string) $this->value;
    }

    public function getType(): string
    {
        return 'float';
    }
}