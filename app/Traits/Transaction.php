<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Transaction
{
    public function selectUserRandom(string $rol, int $office, int $length = 1): int
    {
        $query = DB::table('users AS u')
            ->join('user_office AS uo', 'u.id', '=', 'uo.user_id')
            ->join('office AS o', 'uo.office_id', '=', 'o.id')
            ->join('user_rol AS ur', 'u.id', '=', 'ur.user_id')
            ->join('rol AS r', 'ur.rol_id', '=', 'r.id')
            ->where([
                ['u.status', 1],
                ['r.name', '=', $rol],
                ['o.id', '=', $office]
            ])
            ->inRandomOrder()
            ->limit($length)
            ->pluck('u.id')
            ->first();
        return $query;
    }
}