<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class niveles extends Model
{
    use HasFactory;
    protected $table = "niveles";

    protected $fillable = [
      'nombre',
      'descripcion', 
    ];
}
