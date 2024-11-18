<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = 'office';

    protected $fillable = [
        'init',
        'name',
        'level',
        'group',
        'is_reception_desk'
    ];

    public static function receptionDesk(): \Illuminate\Support\Collection
    { 
        return self::join('office_token AS ot', 'ot.office_id', '=', 'office.id')
            ->select(
                'office.id',
                'office.name',
                'office.init'
            )
            ->where('office.status', 1)
            ->where('office.is_reception_desk', 1)
            ->get()
            ->map(function ($item) {
                return [
                    'reception_desk_code' => base64_encode($item->id),
                    'name' => $item->name,
                    'init' => $item->init,
                ];
            });
        ;
    }
}