<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OwnerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Qusay Alkahlout',
        //     'email' => 'qusay@gmail.com',
        //     'password' => Hash::make('123123123'),
        // ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
          ]);

          $roleadmin = Role::create(['name' => 'owner']);

          $permissionsadmin = Permission::pluck('id')->all();

          $roleadmin->syncPermissions($permissionsadmin);

          $admin->assignRole([$roleadmin->id]);

        //   --------------------------------------------------------------------
        $accountant = User::create([
            'name' => 'Accountant',
            'email' => 'accountant@gmail.com',
            'password' => bcrypt('123123123'),
          ]);

          $roleaccountant = Role::create(['name' => 'accountant']);

        //   $permissionsaccountant = Permission::pluck('id')->whereBetween(['id' => ])->all();

          $roleaccountant->syncPermissions([13,18,19,20,21,36,37,38,39,40,41]);

          $accountant->assignRole([$roleaccountant->id]);
    }
}
