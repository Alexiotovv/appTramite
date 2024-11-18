<?php

namespace App\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class VerifyFormDataFiles implements ValidationRule
{
    //public function __construct(public string $format){}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!is_array($value)){
            $fail("El campo $attribute no es tiene el formato requerido para esta solicitud");
            return;
        }
        try{
            switch('receptionDesk'){
                case 'receptionDesk':
                    $this->receptionDesk($value);
                break;
            }
        }catch(Exception $e){
            $fail($e->getMessage());
        }
    }

    private function receptionDesk(mixed $value): bool
    {
        foreach($value as $index => $fileData){
            if (!isset($fileData['name']) || !isset($fileData['doc'])) {
                $i = $index+1;
                throw new Exception("El archivo en la posición {$i} debe incluir un campo 'name' y un archivo 'doc'.");
            }
            $file = $fileData['doc'];
            if (!$file->isValid() || $file->getMimeType() !== 'application/pdf') {
                $j = $index+1;
                throw new Exception("El archivo en la posición {$j} debe ser un PDF válido.");
                if($file->getSize() > 20 * 1024 * 1024){
                    throw new Exception("El archivo en la posición {$j} debe supera los 20MB permitidos por archivo.");
                }
            }
        }
        return true;
    }
}