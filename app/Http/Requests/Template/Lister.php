<?php

namespace App\Http\Requests\Template;

use App\Http\Requests\Template;
use App\Services\CheckPermission;

class Lister extends Template
{    
    public function rules(): array
    {
        return [
            'itemsPerPage' => 'required|integer',
            'page' => 'required|integer',
        ];
    }
}