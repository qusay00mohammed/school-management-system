<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Student;
use App\Models\Library;
use App\Models\Subject;
use App\Models\TheParent;
use App\Models\Teacher;
use App\Models\Fee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('teachers')->delete();
        $teacher1 = new Teacher();
        $teacher1->email = "qusay@gmail.com";
        $teacher1->password = Hash::make('123123123');
        $teacher1->name = "Qusay";
        $teacher1->gender_id = 1;
        $teacher1->joining_date = date('2023-04-15');
        $teacher1->specialization_id = 1;
        $teacher1->address = "Palestine";
        $teacher1->save();

        $teacher2 = new Teacher();
        $teacher2->email = "amal@gmail.com";
        $teacher2->password = Hash::make('123123123');
        $teacher2->name = "Amal";
        $teacher2->gender_id = 1;
        $teacher2->joining_date = date('2023-04-15');
        $teacher2->specialization_id = 1;
        $teacher2->address = "Palestine";
        $teacher2->save();

        $teacher3 = new Teacher();
        $teacher3->email = "engy@gmail.com";
        $teacher3->password = Hash::make('123123123');
        $teacher3->name = "Engy";
        $teacher3->gender_id = 1;
        $teacher3->joining_date = date('2023-04-15');
        $teacher3->specialization_id = 1;
        $teacher3->address = "Palestine";
        $teacher3->save();

        $teacher4 = new Teacher();
        $teacher4->email = "alaa@gmail.com";
        $teacher4->password = Hash::make('123123123');
        $teacher4->name = "Alaa";
        $teacher4->gender_id = 1;
        $teacher4->joining_date = date('2023-04-15');
        $teacher4->specialization_id = 1;
        $teacher4->address = "Palestine";
        $teacher4->save();

        // ---------------------------------------
        DB::table('stages')->delete();
        $stage = [
            ['en'=> 'Primary School', 'ar'=> 'المرحلة الابتدائية'],
            ['en'=> 'middle School', 'ar'=> 'المرحلة الاعدادية'],
            ['en'=> 'High School', 'ar'=> 'المرحلة الثانوية'],
        ];

        foreach ($stage as $s) {
            Stage::create(['name' => $s]);
        }
// -------------------------------------------------
        DB::table('grades')->delete();
        $grade1 = [
            ['en'=> 'First grade',  'ar'=> 'الصف الاول'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third grade',  'ar'=> 'الصف الثالث'],
            ['en'=> 'Fourth grade',  'ar'=> 'الصف الرابع'],
            ['en'=> 'fifth grade',  'ar'=> 'الصف الخامس'],
            ['en'=> 'sixth grade',  'ar'=> 'الصف السادس'],
        ];

        foreach ($grade1 as $g) {
            Grade::create([
                'name' => $g,
                'stage_id' => 1
            ]);
        }

        $grade2 = [
            ['en'=> 'First grade',  'ar'=> 'الصف الاول'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third grade',  'ar'=> 'الصف الثالث'],
        ];

        foreach ($grade2 as $g) {
            Grade::create([
                'name' => $g,
                'stage_id' => 2
            ]);
        }


// -------------------------------------------------
        DB::table('sections')->delete();
        $section1 = [
            ['en' => 'a', 'ar' => 'أ'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];
        foreach ($section1 as $s) {
            $store = Section::create([
                'name' => $s,
                'grade_id' => 1
            ]);
            $store->teachers()->sync(1, 2, 3, 4);
        }

        $section2 = [
            ['en' => 'a', 'ar' => 'أ'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];
        foreach ($section2 as $s) {
            $store = Section::create([
                'name' => $s,
                'grade_id' => 2
            ]);
            $store->teachers()->sync(1, 2, 3, 4);
        }

        $section3 = [
            ['en' => 'a', 'ar' => 'أ'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];
        foreach ($section3 as $s) {
            $store = Section::create([
                'name' => $s,
                'grade_id' => 7
            ]);
            $store->teachers()->sync(1, 2);
        }
// -------------------------------------------------
        DB::table('parents')->delete();
        $parent = new TheParent();
        $parent->email = 'mohammed@gmail.com';
        $parent->password = Hash::make('123123123');
        $parent->father_name = ['en' => 'Mohammed Alkahlout', 'ar' => 'محمد الكحلوت'];
        $parent->father_national_id = '1234567810';
        $parent->father_passport_id = '1234567810';
        $parent->father_phone = '1234567810';
        $parent->father_job = ['en' => 'programmer', 'ar' => 'مبرمج'];
        $parent->father_nationality_id = Nationality::all()->unique()->random()->id;
        $parent->father_bloodType_id =BloodType::all()->unique()->random()->id;
        $parent->father_religion_id = 1;
        $parent->father_address ='Palestine';

        $parent->mother_name = ['en' => 'Ghadeer Alkahlout', 'ar' => 'غدير الكحلوت'];
        $parent->mother_national_id = '1234567810';
        $parent->mother_passport_id = '1234567810';
        $parent->mother_phone = '1234567810';
        $parent->mother_job = ['en' => 'Doctor', 'ar' => 'دكتورة'];
        $parent->mother_nationality_id = Nationality::all()->unique()->random()->id;
        $parent->mother_bloodType_id =BloodType::all()->unique()->random()->id;
        $parent->mother_religion_id = 1;
        $parent->mother_address ='Palestine';
        $parent->save();
// -------------------------------------------------
        DB::table('students')->delete();
        $student = new Student();
        $student->name = ['ar' => 'عدي محمد', 'en' => 'Odai Mohammed'];
        $student->email = 'odai@gmail.com';
        $student->password = Hash::make('123123123');
        $student->academic_year = 2023;
        $student->date_birthday = date('2010-01-01');
        $student->gender_id = 1;
        $student->nationality_id = Nationality::all()->unique()->random()->id;
        $student->bloodType_id = BloodType::all()->unique()->random()->id;
        $student->section_id = 1;
        $student->parent_id = 1;
        $student->save();
// -------------------------------------------------
        $book = new Library();
        $book->title = "كتاب الحاسب الالي";
        $book->section_id = 1;
        $book->teacher_id = 1;
        $book->file_name = "book.pdf";
        $book->save();
// -------------------------------------------------

        $subject1 = new Subject();
        $subject1->name = ['en' => "Arabic", 'ar' => "عربي"];
        $subject1->grade_id = 1;
        $subject1->teacher_id = 1;
        $subject1->save();

        $subject2 = new Subject();
        $subject2->name = ['en' => "Mathematics", 'ar' => "رياضيات"];
        $subject2->grade_id = 1;
        $subject2->teacher_id = 2;
        $subject2->save();

        $subject3 = new Subject();
        $subject3->name = ['en' => "Islamic", 'ar' => "دين"];
        $subject3->grade_id = 1;
        $subject3->teacher_id = 3;
        $subject3->save();

        $subject4 = new Subject();
        $subject4->name = ['en' => "technology", 'ar' => "تكنولوجيا"];
        $subject4->grade_id = 1;
        $subject4->teacher_id = 4;
        $subject4->save();
// -------------------------------------------------
        $fees = new Fee();
        $fees->name = ['en' => "Stady Fees", 'ar' => "رسوم دراسية"];
        $fees->amount  =10000;
        $fees->grade_id  =1;
        $fees->note  = "";
        $fees->academic_year  =2023;
        $fees->fee_type  =1;
        $fees->save();

        $fees1 = new Fee();
        $fees1->name = ['en' => "Bus Fees", 'ar' => "رسوم باص"];
        $fees1->amount  =2000;
        $fees1->grade_id  =1;
        $fees1->note  = "";
        $fees1->academic_year  =2023;
        $fees1->fee_type  =2;
        $fees1->save();


    }
}
