<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CreditExhausted()
 * @method static static LoginRequested()
 */
final class ActivityType extends Enum
{
    const CreditExhausted = 0;
    const LoginRequested = 1;
}
