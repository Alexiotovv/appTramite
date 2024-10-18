<?php

namespace App\Enums; 

enum TokenAbility: string
{
    case REFRESH_ACCESS_TOKEN = 'refresh-access-token';
    case OPERATION_TOKEN = "operation-api-token";
}