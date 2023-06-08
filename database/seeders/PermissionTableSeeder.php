<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'stage',
            'add stage',
            'edit stage',
            'delete stage',

            'grade',
            'add grade',
            'delete grade',
            'edit grade',

            'section',
            'add section',
            'edit section',
            'delete section',

            // 'student',
            'list student',
            'add student',
            'view student data',
            'edit student',
            'delete student',
            'add fee to student',
            'catch receipt to student',
            'exclusion of fees',
            'bill of exchange',

            'list promotion',
            'add promotion',


            'list graduated',
            'add graduated',
            'return graduated',
            'delete graduated',

            'teacher',
            'add teacher',
            'edit teacher',
            'delete teacher',

            'parent',
            'add parent',
            'edit parent',
            'delete parent',


            // Error fees
            'study fees',
            'add study fee',
            'edit study fee',
            'delete study fee',
            'view study fee',

            'study bills',



            'attendace',
            'list students attendace',

            'subject',
            'add subject',
            'edit subject',
            'delete subject',

            // 'exams',
            'list exams',
            'add quizze',
            'edit quizze',
            'delete quizze',
            'list questions',
            'add questions',
            'edit questions',
            'delete questions',

            'library',
            'add book',
            'edit book',
            'delete book',
            'download book',


            'online classes',
            'create online classes',
            'delete online classes',
            'join online classes',

            'settings',

            'admins',
            // Permissions


          ];

          foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
