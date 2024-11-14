<?php

namespace Database\Seeders\Fakers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Offices extends Seeder
{
    private $office = [
        [
            "name" =>'GERENCIA REGIONAL',
            "init" => 'GR',
            'level' => 1,
        ], 
        [
            "name" =>'RECURSOS INHUMANOS',
            "init" => 'RIH',
            'level' => 1,
        ], 
        [
            "name" =>'ADMINISTRACIÓN DE CHOCOLATADAS',
            "init" => 'AD',
            'level' => 1,
        ], 
        [
            "name" =>'GERENCIA REGIONAL DE INFRAESTRUCTURA',
            "init" => 'GRI',
            'level' => 1,
        ], 
    ];

    private $officeLow = [
        [
            "name" =>'OFICINA DE LOGISTICA',
            "init" => 'OL',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'SILLA DE PARTES',
            "init" => 'SP',
            'level' => 2,
            'is_reception_desk' => 1
        ], 
        [
            "name" =>'OFICINA OCULTA ENTRE LA HOJA',
            "init" => 'OOEH',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'OFICINA OCULTA ENTRE LA NIEBLA',
            "init" => 'OOEN',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'OFICINA OCULTA ENTRE LA ARENA',
            "init" => 'OOEA',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'OFICINA OCULTA ENTRE LA NUEBES',
            "init" => 'OOENB',
            'level' => 2,
            'is_reception_desk' => 1
        ], 
        [
            "name" =>'OFICINA OCULTA ENTRE LA LLUVIA',
            "init" => 'OOEL',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'OFICINA QUE HACE ALGO',
            "init" => 'OHA',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'OFICINA CIEN PORCIENTO REAL',
            "init" => 'OCPR',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
        [
            "name" =>'OFICINA CIEN PORCIENTO FALSA',
            "init" => 'OCPF',
            'level' => 2,
            'is_reception_desk' => 0
        ], 
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function(){
            $ids = $this->makeOfficesLevelOne();
            foreach($this->officeLow as $value){
                $id = DB::table('office')->insertGetId([
                    'name' => $value['name'],
                    'init' => $value['init'],
                    'level' => $value['level'],
                    'group' => $ids[random_int(0,3)],
                    'is_reception_desk' => $value['is_reception_desk']
                ]);
                if($value['is_reception_desk'] == 1){
                    $this->makeTokenOffice($id);
                }
            }
        }); 
    }
    public function makeOfficesLevelOne(): array
    {
        $keys = [];
        foreach($this->office as $value){
            $keys[] = DB::table('office')->insertGetId([
                'name' => $value['name'],
                'init' => $value['init'],
                'level' => $value['level']
            ]);
        }
        return $keys;
    }

    public function makeTokenOffice(int $id)
    {
        DB::table('office_token')->insert([
            'office_id' => $id,
            'access_token' => Str::random(8),
            'indentify_code' => Str::random(4)
        ]);
    }
}