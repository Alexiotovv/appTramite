<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TypeDocument extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            $file = json_decode(file_get_contents(storage_path('json/Tra_M_Tipo_Documento_202411051013.json')));
            $docs = [];
            foreach($file AS $doc){
                $docs[] = [
                    'name' => $doc->cDescTipoDoc,
                    'init' => $this->makeInitial(str_replace(' ', ' ',$doc->cDescTipoDoc)),
                    'created_at' => now()
                ];
            }

            $this->docStorage($docs);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            Log::error(get_class($this) . ' : ' . $e->getMessage());
        }
    }

    private function docStorage(array $docs)
    {
        DB::table('type_document')->insert($docs);
    }
    
    private function makeInitial(string $name): string
    {
        $string = explode(' ', strtoupper($name));
        $initial = '';
        foreach ($string as $value) {
            if (!in_array($value, ['DE', '-'])) {
                $initial .= $value[0];
            }
        }
        return $initial;
    }
    
}