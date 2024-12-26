<?php

namespace App\Services;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class TemplateWord
{
    private $metadata;

    public function __construct(public int $typeDoc){
        $this->metadata = Cache::rememberForever('metadata_template_' . $this->typeDoc, function(){
            return DB::table('metada_template')
                ->select(
                    'path_template',
                    'year_name',
                    'path_logo_entity',
                    'path_logo_digital_government',
                    'type_doc'
                )
                ->where(function($query){
                    $query->where('type_doc', $this->typeDoc)
                    ->orWhere('is_default', 1);
                })
                ->orderByRaw("CASE WHEN type_doc = ? THEN 1 ELSE 2 END", [$this->typeDoc])
                ->first();
        });
    }

    public function run(string $destination, string $correlative, string $subject, string $date, array $references = null): string
    {
        $templatePath = storage_path($this->metadata->path_template);
        $templateProcessor = new TemplateProcessor($templatePath);       
        $templateProcessor->setValue('destination', $destination);
        $templateProcessor->setValue('correlative', $correlative);
        $templateProcessor->setValue('location', config('app.location'));
        $templateProcessor->setValue('date', $this->convertDateToStringDate($date));
        $templateProcessor->setImageValue('image', storage_path('assets/logo.png'));

        $pathDoc = date('Y/m/d') . 'YmdHis.docx';
        $modifiedDocPath = storage_path('app/private/'. $pathDoc);
        $templateProcessor->saveAs($modifiedDocPath);
        return $modifiedDocPath;
    }

    private function convertDateToStringDate(string $dateString): string
    {
        \Carbon\Carbon::setLocale('es');  
        $date = Carbon::createFromFormat('Y-m-d', $dateString);
        $formattedDate = $date->isoFormat('dddd, D [de] MMMM [de] YYYY'); 
        return $formattedDate;
    }
}