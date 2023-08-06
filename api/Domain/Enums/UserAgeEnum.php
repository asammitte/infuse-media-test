<?php

namespace Domain\Enums;

use Common\Traits\EnumToArrayTrait;

enum UserAgeEnum: int
{
    use EnumToArrayTrait;

    case LT_20 = 0;
    case BTW_20_60 = 1;
    case GT_60 = 2;
}
