<?php

namespace App\Model\InformationItem;

use App\Constant\InformationItemConstants;

final class InformationItemFactory
{
    public static function create(string $itemName): ?InformationTypeInterface
    {
        $informationType = null;
        if (in_array($itemName, InformationItemConstants::DATE_ATTRIBUTES)) {
            $informationType = new DateInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::FLOAT_ATTRIBUTES)) {
            $informationType = new FloatInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::PERCENTAGE_ATTRIBUTES)) {
            $informationType = new PercentageInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::QUANTITY_ATTRIBUTES)) {
            $informationType = new QuantityInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::RANGE_ATTRIBUTES)) {
            $informationType = new RangeInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::RATIO_ATTRIBUTES)) {
            $informationType = new RatioInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::STRING_ATTRIBUTES)) {
            $informationType = new StringInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::VOLATILITY_ATTRIBUTES)) {
            $informationType = new VolatilityInformationType($itemName);
        } elseif (in_array($itemName, InformationItemConstants::VOLUME_ATTRIBUTES)) {
            $informationType = new VolumeInformationType($itemName);
        }

        return $informationType;
    }
}