<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Fakers\Offices;
use Database\Seeders\Fakers\Faker;
use Database\Seeders\RolePermissions;
use Database\Seeders\Fakers\Users;

class Fakers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            //Offices::class,
            RolePermissions::class,
            Users::class
            //Faker::class,
        ]);
    }
}
