<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class TemplateWord
{
    public $metadata;
    public function __construct(
        public string $correlative, 
        public string $subject, 
        public string $officeOneAboveAll, 
        public string $typeDoc,
        public ?string $office = null
    ){
        $this->metadata = Cache::rememberForever('metadata_template', function(){
            return DB::table('metada_template')
                ->select(
                    'year_name AS yearName',
                    'path_logo AS pathLogo',
                    'address_footer AS addressFooter',
                    'margin_top AS marginTop',
                    'margin_bottom AS marginBottom',
                    'margin_left AS marginLeft',
                    'margin_right AS marginRight',
                )
                ->first();
        });
    }

    public function run(): string
    {
        
        return '';
    }
}