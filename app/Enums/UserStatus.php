<?php

namespace App\Enums;

enum UserStatus: Int
{
    case ADMIN = 1;
    case USER = 2;
}
