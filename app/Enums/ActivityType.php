<?php

namespace App\Enums;

enum ActivityType: int
{
    case CreditExhausted = 0;
    case LoginRequested = 1;
    case WebsiteVerification = 2;
}
