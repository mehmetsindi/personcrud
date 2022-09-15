<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\Address\Models\AddressModel;
use App\Modules\Person\Models\PersonModel;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Modules\Person\Models\PersonModel::factory(20)->create();
        \App\Modules\Address\Models\AddressModel::factory(20)->create();
            //PersonModel::factory(50)->create();
            //AddressModel::factory(30)->create();


    }
}
