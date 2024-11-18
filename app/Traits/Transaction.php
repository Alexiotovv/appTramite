<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Transaction
{
    public function selectUserRandom(int $lenght = 1, string $rol, int $office)
    {
        return DB::table('users AS u')
            ->join('user_office AS uo', 'u.id', '=', 'uo.user_id')
            ->join('office AS o', 'uo.office_id', '=', 'o.id')
            ->join('user_rol AS ur', 'u.id', '=', 'ur.user_id')
            ->join('rol AS r', 'ur.rol_id', '=', 'r.id')
            ->where('u.status', 1)
            ->where('r.name' , '=',  $rol)
            ->where('o.id', $office)
            ->inRandomOrder()
            ->limit($lenght)
            ->pluck('u.id');
    }
}