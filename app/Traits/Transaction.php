<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Transaction
{
    public function selectUserRandom(int $user, string $rol, bool $autoBalance = true)
    {
        DB::table('')
    }
}