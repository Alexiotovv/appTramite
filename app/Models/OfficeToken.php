<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeToken extends Model
{
    protected $table = 'office_token';
    
    protected $fillable = [
        'office_id',
        'access_token',
        'identify_code'
    ];
}