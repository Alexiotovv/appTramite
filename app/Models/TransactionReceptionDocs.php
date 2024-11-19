<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TransactionReceptionDocs extends Model
{
    protected $table = 'transaction_reception_docs';
    
    protected $fillable = [
        'transaction_reception_id',
        'type_path',
        'name_file',
        'path_file'
    ];

    public static function storeDocs(int $id, string $nameFile, string $pathFile, int $typePath = 1): void
    {   
        try{
            $transaction = self::create([
                'transaction_reception_id' => $id,
                'type_path' => $typePath,
                'name_file' => $nameFile,
                'path_file' => $pathFile
            ]);
        }catch(Exception $e){
            Log::error('Error al almacenar documento: ' . $e->getMessage());
        }
    }
}