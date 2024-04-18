<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case CLIENT = 'client';
    case EMPLOYEE = 'employee';
    case MANAGER = 'manager';
    case ADMIN = 'admin';
}
