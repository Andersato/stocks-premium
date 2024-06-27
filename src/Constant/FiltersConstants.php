<?php

declare(strict_types=1);


namespace App\Constant;

final class FiltersConstants
{
    final public const ANY_FILTER = 'Any';

    final public const MARKET_CAP_LESS_THAN = '< 300 MM';
    final public const MARKET_CAP_BETWEEN_300_TO_1000 = '300 to 1000 MM';
    final public const MARKET_CAP_BETWEEN_1000_TO_10000 = '1000 to 10000 MM';
    final public const MARKET_CAP_BETWEEN_10000_TO_200000 = '10000 to 200000 MM';
    final public const MARKET_CAP_MORE_THAN_200000 = '> 200000 MM';

    final public const PER_LESS_THAN_0 = '< 0';
    final public const PER_BETWEEN_0_TO_15 = '0 to < 15';
    final public const PER_BETWEEN_15_TO_30 = '15 to < 30';
    final public const PER_MOTE_THAN_30 = '> 30';

    final public const RANGE_52W_MORE_THAN_10 =  '> 10%';
    final public const RANGE_52W_BETWEEN_5_TO_10 =  '5% to 10%';
    final public const RANGE_52W_BETWEEN_0_TO_5 =  '0% to 5%';
    final public const RANGE_52W_BETWEEN_0_TO_MINUS_5 =  '0% to -5%';
    final public const RANGE_52W_BETWEEN_MINUS_5_TO_MINUS_10 =  '-5% to -10%';
    final public const RANGE_52W_BETWEEN_MINUS_10_TO_MINUS_15 =  '-10% to -15%';
    final public const RANGE_52W_BETWEEN_LESS_MINUS_15 =  '< -15%';
}