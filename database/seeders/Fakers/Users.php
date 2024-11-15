<?php

namespace Database\Seeders\Fakers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = $this->offices();
        $totalOffices = count($offices);
        $roles = $this->rol();
        $totalRole = count($roles);
        for($i = 1; $i <= 40; $i++){
            $ids = $this->createUser();
            $this->roleUser($ids, $roles[random_int(0, $totalRole-1)]);
            $this->officeUser($ids, $offices[random_int(0, $totalOffices-1)]);
        }   
        
    }
    
    public function createUser(): int
    {
        return DB::table('users')->insertGetId([
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'type_doc' => 'DNI',
            'number_doc' => random_int(70000000, 79999999),
            'status' =>  1,
            'password' => Hash::make('hola5.2'),
            'created_at' => now() 
        ]);
    }
    
    public function offices(): array
    {
        $offices = DB::table('office')->pluck('id')->toArray();
        return $offices;
    }
    
    public function rol(): array
    {
        return  DB::table('rol')->pluck('id')->toArray();
    }

    public function roleUser($user, $rol)
    {
        DB::table('user_rol')->insert([
            'user_id' => $user,
            'rol_id' => $rol
        ]);
    }

    public function officeUser($user, $office)
    {
        DB::table('user_office')->insert([
            'user_id' => $user,
            'office_id' => $office,
            'status' => 1,
            'created_at' => now()
        ]);
    }
}