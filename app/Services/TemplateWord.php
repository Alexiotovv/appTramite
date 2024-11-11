<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class TemplateWord
{
    public $metadata;
    public function __construct(
        public string $correlative, 
        public string $subject, 
        public string $officeOneAboveAll, 
        public string $typeDoc,
        public string $office = null
    ){

    }
}