<?php

namespace App\Services\Tokens;

use App\Enums\TokenAbility;
use App\Services\Contracts\TokenInterface;
use App\Enums\TokenName;
use App\Models\User;

class Operation implements TokenInterface
{
    public function generate(User $user): string
    {
        $abilities = array_merge([TokenAbility::OPERATION_TOKEN->value], $this->setAbilities($user));
        $token  = $user->createToken(
            TokenName::OPERATION->value,
            $abilities
        )->plainTextToken;
        return $token;
    }

    public function setAbilities(User $token): array
    {
        return [];
    }
}