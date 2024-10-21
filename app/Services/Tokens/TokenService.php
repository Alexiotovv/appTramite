<?php

namespace App\Services\Tokens;

use App\Models\User;
use App\Exceptions\Services\Tokens;
use App\Services\Tokens\Operation;
use App\Services\Tokens\Update;


class TokenService
{    
    public static function refreshTokens(User $user): array
    {
        if($user->status == 0){
            throw new Tokens('User not authorized');
        }
        $user->tokens()->delete();
        $tokenOperation = new Operation; 
        $tokenUpdate = new Update;
        return [
            $tokenOperation->generate($user),
            $tokenUpdate->generate($user)
        ];
    }
}