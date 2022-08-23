<?php

namespace App\Enums;

use Othyn\PhpEnumEnhancements\Traits\EnumEnhancements;

enum RoleSlug: string
{
    use EnumEnhancements;

    case WORKER = 'worker';
    case USER = 'user';
}
