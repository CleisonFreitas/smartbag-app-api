<?php

declare(strict_types=1);

namespace App\Enum;

enum LimitPaginateEnum: int
{
    case LimitMax = 200000;
    case LimitMin = 20;
}
