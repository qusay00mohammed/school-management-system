<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_year', 'value' => '2023-2024'],
            ['key' => 'abbreviated_school_name', 'value' => 'MS'],
            ['key' => 'school_name', 'value' => 'Sparker x International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2021'],
            ['key' => 'end_second_term', 'value' => '01-03-2022'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'القاهرة'],
            ['key' => 'school_email', 'value' => 'info@morasoft.com'],
            ['key' => 'logo', 'value' => 'logo.png'],
        ];

        DB::table('settings')->insert($data);
    }
}
