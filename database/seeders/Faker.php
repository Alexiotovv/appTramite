<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Faker extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        DB::transaction(function(){
            $user = $this->user();
            $role = $this->role();
            $permission = $this->permission();
            $this->rolePermission($role, $permission);
            $this->roleUse($user, $role);
        });
    }

    public function user(): int
    {
        return DB::table('users')->insertGetId([
            'name' => 'zoldyck',
            'last_name' => 'the humman',
            'type_doc' => 'dni',
            'number_doc' => 72727272,
            'email' => 'zoldyck@gmail.com',
            'status' => random_int(0,1),
            'email_verified_at' => now(),
            'password' => Hash::make('marcelo22.--')
        ]);
    }

    public function role(): int 
    {  
        return DB::table('rol')->insertGetId([
            'name' => 'the_god_hand',
            'description' => ':)',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    
    public function permission(): int
    {
        return DB::table('permission')->insertGetId([
            'name' => 'maker',
            'descripcion' => ':)',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function rolePermission(int $id, int $permission)
    {
        DB::table('rol_permission')->insert([
            'rol_id' => $id,
            'permission_id' => $permission,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function roleUse(int $id, int $role)
    {
        DB::table('user_rol')->insert([
            'user_id' => $id,
            'rol_id' => $role
        ]);
    }
}