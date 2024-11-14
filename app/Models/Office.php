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

    public static function receptionDesk(): \Illuminate\Database\Eloquent\Collection
    { 
        return self::join('office_token AS ot', 'ot.office_id', '=', 'office.id')->select(
                'office.id',
                'office.name',
                'office.init',
                'ot.identify_code'
            )
            ->where('office.status', 1)
            ->where('office.is_reception_desk', 1)
            ->get();
        ;
    }
}