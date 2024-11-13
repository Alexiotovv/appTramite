<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Concurrency;

class RolePermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = json_decode(file_get_contents(storage_path('json/role_permissions.json')));
    
        DB::transaction(function() use ($json) {
            foreach ($json as $value) {
                $rolId = $this->storeRol($value->role, $value->description);
                $permissions = [];
                foreach ($value->permissions as $permissionValue) {
                    $permissions[] = $this->storePermission($permissionValue->name, $permissionValue->description);
                }
                if (!empty($permissions)) {
                    foreach ($permissions as $permissionId) {
                        $this->storeRolPermission($rolId, $permissionId);
                    }
                }
            }
        });
    }
    
    public function storePermission(string $name, string $description)
    {
        $exists = DB::table('permission')->where('name', $name)->first();
        if (!$exists) {
            return DB::table('permission')->insertGetId([
                'name' => $name,
                'descripcion' => $description,
                'created_at' => now()
            ]);
        } 
        return $exists->id;
    }
    
    public function storeRol(string $name, string $description)
    {
        $exists = DB::table('rol')->where('name', $name)->first();
        if (!$exists) {
            return DB::table('rol')->insertGetId([
                'name' => $name,
                'description' => $description,
                'created_at' => now()
            ]);
        }
        return $exists->id;
    }
    
    public function storeRolPermission(int $rol, int $permission)
    {
        $exists = DB::table('rol_permission')
            ->where('rol_id', $rol)
            ->where('permission_id', $permission)
            ->exists();
        if (!$exists) {
            DB::table('rol_permission')->insert([
                'rol_id' => $rol,
                'permission_id' => $permission,
                'created_at' => now()
            ]);
        }
    }
}