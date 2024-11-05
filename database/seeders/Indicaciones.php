<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Indicaciones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            $file = json_decode(file_get_contents(storage_path('json/Tra_M_Indicaciones_202411051156.json')));
            DB::transaction();
            
            DB::rollBack();
        }catch(Exception $e){
            Log::error(get_class($this) . ':' . $e->getMessage());
            DB::rollBack();
        }
    }
}