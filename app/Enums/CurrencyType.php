<?php

namespace App\Enums;

use Othyn\PhpEnumEnhancements\Traits\EnumEnhancements;

enum CurrencyType: string
{
    use EnumEnhancements;

    case USD = 'USD';
}
