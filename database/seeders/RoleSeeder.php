<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //   Role::factory(4)->create();
        Role::create([
            "name" => "Pemilik",
        ]);
        Role::create([
            "name" => "Admin",
        ]);
        Role::create([
            "name" => "Teknisi",
        ]);
        Role::create([
            "name" => "Pelanggan",
        ]);
    }
}
