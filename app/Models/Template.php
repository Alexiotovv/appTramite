<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'metadata_template';
    
    protected $fillable = [
        'path_template',
        'year_name',
        'path_logo_entity',
        'path_logo_digital_government', 
        'type_doc',
        'is_default'
    ];
}