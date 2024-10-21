<?php

namespace App\Services\Contracts;
use App\Models\User;

interface TokenInterface
{
    public function generate(User $user): string;
}