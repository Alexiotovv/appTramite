<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpWord\TemplateProcessor;

class TemplateWord
{
    public $metadata;

    public function __construct(public int $typeDoc){
        $this->metadata = Cache::rememberForever('metadata_template_' . $this->typeDoc, function(){
            return DB::table('metada_template')
                ->select(
                    'path_template',
                    'year_name',
                    'path_logo_entity',
                    'path_logo_digital_government',
                    'type_doc',
                    'requirements'
                )
                ->first();
        });
    }

    public function run(): string
    {
        $templatePath = storage_path('templates/prueba.docx');

        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('hola1', 'Juan Pérez');

        $templateProcessor->setImageValue('image', storage_path('assets/logo.png'));

        $modifiedDocPath = storage_path('app/public/aaaa.docx');
        $templateProcessor->saveAs($modifiedDocPath);
        return $modifiedDocPath;
    }

    private function docType()
    {

    }
}