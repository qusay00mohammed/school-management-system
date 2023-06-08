<?php

namespace Database\Seeders;

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
        $this->call(BloodTypeSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(SpecializationSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SettingSeeder::class);

        $this->call(PermissionTableSeeder::class);
        $this->call(OwnerUserSeeder::class);

        $this->call(AllSeeder::class);
    }
}
