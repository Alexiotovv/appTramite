<?php

namespace App\Http\Requests\Template;

use Exception;
use App\Http\Requests\Template;

class Lister extends Template
{    
    public string $permissions = 'manage_templates';

    public function rules(): array
    {
        return [
            'itemsPerPage' => 'required|integer',
            'page' => 'required|integer',
        ];
    }
}