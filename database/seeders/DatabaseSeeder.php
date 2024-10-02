<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        DB::table('users')->insert([
            'name'=>'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'status' => 1,
            'password' => Hash::make('123456'),
            'status'=>1,
        ]);
    }
}
