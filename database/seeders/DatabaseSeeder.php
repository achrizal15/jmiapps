<?php

namespace Database\Seeders;

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
        User::factory(100)->create();
        Package::factory(5)->create();
        Inventory::factory(100)->create();
        Expenditure::factory(100)->create();
    }
}
