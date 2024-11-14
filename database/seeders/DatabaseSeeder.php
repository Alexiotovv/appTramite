<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Fakers\Offices;
use Database\Seeders\Fakers\Faker;
use Database\Seeders\RolePermissions;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            Offices::class,
            RolePermissions::class,
            Faker::class,
        ]);
    }
}