<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FakerUser extends Seeder
{
    private $role = [
        'admin',
        'asistente',
        'visor'
    ];

    /**
     * Run the database seeds.
    */
    
    public function run(): void
    {
        for($i = 1; $i <=4; $i++){
            DB::table('users')->insert([
                'name' => fake()->name(),
                'lastname' => fake()->lastName(),
                'type_doc' => 'dni',
                'number_doc' => random_int(72752219, 72752299),
                'email' => fake()->email(),
                'role' => $this->role[random_int(0,2)],
                'status' => random_int(0,1),
                'email_verified_at' => null,
                'password' => Hash::make('hola123')
            ]);
        }
    }
}