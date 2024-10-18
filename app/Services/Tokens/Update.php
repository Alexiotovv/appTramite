<?php

namespace App\Services\Tokens;
use App\Services\Contracts\TokenInterface;
use App\Models\User;
use App\Enums\TokenName;
use App\Enums\TokenAbility;

class Update implements TokenInterface
{

    public function generate(User $user): string
    {
        $token = $user->createToken(
            TokenName::UPDATE->value, 
            [TokenAbility::REFRESH_ACCESS_TOKEN->value],
            now()->addMinutes(config('sanctum.refresh_expiration'))
        )
        ->plainTextToken;
        return $token;
    }
}