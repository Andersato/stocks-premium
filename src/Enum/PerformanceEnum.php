<?php

namespace App\Enum;

enum PerformanceEnum: string
{
    case SmallCaps = 'Small Caps';
    case MidCaps = 'Mid Caps';
    case LargeCaps = 'Large Caps';
    case MegaCaps = 'Mega Caps';
    case TopGainers = 'Top Gainers';
    case ToLosers = 'Top Losers';
}
