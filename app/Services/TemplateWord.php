<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;

class TemplateWord
{
    public $metadata;
    //public function __construct(
    //    public string $correlative, 
    //    public string $subject, 
    //    public string $officeOneAboveAll, 
    //    public string $typeDoc,
    //    public ?string $office = null,
    //    public ?string $date = null
    //){
        //$this->metadata = Cache::rememberForever('metadata_template', function(){
        //    return DB::table('metada_template')
        //        ->select(
        //            'year_name AS yearName',
        //            'path_logo AS pathLogo',
        //            'address_footer AS addressFooter',
        //            'margin_top AS marginTop',
        //            'margin_bottom AS marginBottom',
        //            'margin_left AS marginLeft',
        //            'margin_right AS marginRight',
        //        )
        //        ->first();
        //});
    //}

    public function run()
    {
        $templatePath = storage_path('templates/prueba.docx');
        $phpWord = IOFactory::load($templatePath);

        // Si usas TemplateProcessor, puedes seguir con el siguiente paso
        $templateProcessor = new TemplateProcessor($templatePath);

        // Reemplazar valores de texto
        $templateProcessor->setValue('hola1', 'Juan Pérez');

        // Reemplazar imagen
        $templateProcessor->setImageValue('image', storage_path('assets/logo.png'));

        // Guardar el archivo modificado
        $modifiedDocPath = storage_path('app/public/aaaa.docx');
        $templateProcessor->saveAs($modifiedDocPath);
    }
}