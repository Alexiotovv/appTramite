<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function list(int $page = 1, int $itemsPerPage = 15)
    {
        DB::table('metadata_template')
            ->select(
                'path_template',
                'year_name',
                'path_logo_entity',
                'path_logo_digital_government',
                'path_logo_digital_government',
                'type_doc',
                'is_default'
            )
            ->paginate($itemsPerPage, );
    }
}