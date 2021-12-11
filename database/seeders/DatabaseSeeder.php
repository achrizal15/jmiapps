<?php

namespace Database\Seeders;

use App\Models\Blok;
use App\Models\Expenditure;
use App\Models\Inventory;
use App\Models\Package;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);

        User::factory(10)->create();
        Package::factory(3)->create();
        Inventory::factory(50)->create();
        Expenditure::factory(50)->create();     
    }
}
