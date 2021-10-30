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

        User::factory(100)->create();
        Package::factory(5)->create();
        Inventory::factory(100)->create();
        Expenditure::factory(100)->create();
        Blok::create([
            "name"=>"BLOK A",
            "detail_address"=>"barat",
            "collector_id"=>"15",
        ]);
        Blok::create([
            "name"=>"BLOK B",
            "detail_address"=>"timur",
            "collector_id"=>"12",
        ]);
        Blok::create([
            "name"=>"BLOK C",
            "detail_address"=>"selatan",
            "collector_id"=>"5",
        ]);
    }
}
