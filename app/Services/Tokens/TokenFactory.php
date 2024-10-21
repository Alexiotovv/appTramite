<?php

namespace App\Services\Tokens;

use App\Services\Contracts\TokenInterface;
use App\Services\Tokens\Update;
use App\Services\Tokens\Operation;

class TokenFactory
{
    public static function create(string $type): TokenInterface
    {
        switch($type){
            case 'update':
                return new Update;
            case 'operation':
                return new Operation;
            default:
                throw new \InvalidArgumentException('Invalid token type');
        }
    }
}