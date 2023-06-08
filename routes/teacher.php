<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Fee\CatchReceiptController;
use App\Http\Controllers\Fee\ProcessintFeeController;
use App\Http\Controllers\Fee\ReceiptController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Stage\StageController;
use App\Http\Controllers\Student\GraduatedController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\PromotionController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Fee\FeeInvoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnlineClass\OnlineClassController;
// use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quizz\QuizzController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\Dashboard\ProfileController;
use App\Http\Controllers\Teacher\Dashboard\QuestionController;
use App\Http\Controllers\Teacher\Dashboard\QuizzeController;
use App\Http\Controllers\Teacher\Dashboard\StudentController as DashboardStudentController;
use App\Http\Controllers\Teacher\Dashboard\ZoomOnlineClassesController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/teacher',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher' ]
    ], function(){

        Route::get('/dashboard', function () {

            $sections_id = \App\Models\Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
            $count_sections = $sections_id->count();
            $count_students = \App\Models\Student::whereIn('section_id', $sections_id)->count();

            return view('pages.teacher.dashboard.dashboard', compact('count_sections', 'count_students'));
        })->name('teacher.dashboard');


        Route::get('sections', [DashboardStudentController::class, 'sections'])->name('teacher.sections');
        Route::get('students', [DashboardStudentController::class, 'students'])->name('teacher.students');
        Route::post('attendences/{id}', [DashboardStudentController::class, 'attendences'])->name('teacher.attendences');

        Route::get('attendance_search', [DashboardStudentController::class, 'attendences_report'])->name('teacher.attendance.report');
        Route::post('attendance_search', [DashboardStudentController::class, 'attendences_search'])->name('teacher.attendance.search');


        Route::get('profile', [ProfileController::class, 'index'])->name('teacher.profile.show');
        Route::post('profile/{id}', [ProfileController::class, 'update'])->name('teacher.profile.update');


        Route::get('quizze', [QuizzeController::class, 'index'])->name('teacher.quizze.index');
        Route::get('quizze/create', [QuizzeController::class, 'create'])->name('teacher.quizze.create');
        Route::post('quizze/store', [QuizzeController::class, 'store'])->name('teacher.quizze.store');
        Route::post('quizze/{id}/destroy', [QuizzeController::class, 'destroy'])->name('teacher.quizze.destroy');
        Route::get('quizze/{id}/edit', [QuizzeController::class, 'edit'])->name('teacher.quizze.edit');
        Route::post('quizze/{id}/update', [QuizzeController::class, 'update'])->name('teacher.quizze.update');
        Route::get('quizze/{id}/show', [QuizzeController::class, 'show'])->name('teacher.quizze.show');


        Route::get('question/{id}/show', [QuestionController::class, 'show'])->name('teacher.question.show');
        Route::post('question/{id}/store', [QuestionController::class, 'store'])->name('teacher.question.store');
        Route::post('question/{id}/destroy', [QuestionController::class, 'destroy'])->name('teacher.question.destroy');

        Route::get('question/{id}/edit', [QuestionController::class, 'edit'])->name('teacher.question.edit');
        Route::post('question/{id}/update', [QuestionController::class, 'update'])->name('teacher.question.update');




        Route::get('online_classes', [ZoomOnlineClassesController::class, 'index'])->name('teacher.online_classes.index');
        Route::get('online_classes/direct', [ZoomOnlineClassesController::class, 'direct'])->name('teacher.online_classes.direct');
        Route::get('online_classes/indirect', [ZoomOnlineClassesController::class, 'indirect'])->name('teacher.online_classes.indirect');
        Route::post('online_classes/storeDirect', [ZoomOnlineClassesController::class, 'storeDirect'])->name('teacher.online_classes.storeDirect');
        Route::post('online_classes/storeIndirect', [ZoomOnlineClassesController::class, 'storeIndirect'])->name('teacher.online_classes.storeIndirect');
        Route::post('online_classes/{id}/destroy', [ZoomOnlineClassesController::class, 'destroy'])->name('teacher.online_classes.destroy');



        // Route::resource('stage', StageController::class);

        // Route::resource('quizzes', 'QuizzController');
        // Route::resource('questions', 'QuestionController');
        // Route::resource('online_zoom_classes', 'OnlineZoomClassesController');
        // Route::get('/indirect', 'OnlineZoomClassesController@indirectCreate')->name('indirect.teacher.create');
        // Route::post('/indirect', 'OnlineZoomClassesController@storeIndirect')->name('indirect.teacher.store');

        // Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('home');


        // Route::resource('grade', GradeController::class);
        // Route::post('delete_all_item', [GradeController::class, "delete_all_item"])->name('delete_all_item');
        // Route::post('filter_grade', [GradeController::class, "filter_grade"])->name('filter_grade');

        // Route::resource('section', SectionController::class);
        // Route::get('filter_grade_by_stage/{id}', [SectionController::class, "filter_grade_by_stage"]);

        // Route::view('parents','livewire.parent.show')->name('livewire.parent');

        // Route::resource('teachers', TeacherController::class);

        // Route::resource('students', StudentController::class);
        // Route::get('filter_section_by_grade/{id}', [StudentController::class, "filter_section_by_grade"]);

        // Route::post('uploadAttachment/{id}', [StudentController::class, "uploadAttachment"])->name('uploadAttachment');
        // Route::get('downloadAttachment/{id_attachment}/forStudent/{id_student}', [StudentController::class, "downloadAttachment"])->name('downloadAttachment');
        // Route::post('deleteAttachment/{id_attachment}/forStudent/{id_student}', [StudentController::class, "deleteAttachment"])->name('deleteAttachment');

        // Route::resource('promotion', PromotionController::class);
        // Route::resource('graduated', GraduatedController::class);
        // Route::resource('fees', FeeController::class);
        // Route::resource('fee_invoices', FeeInvoiceController::class);

        // Route::resource('catchReceipts', CatchReceiptController::class);
        // Route::resource('processingFees', ProcessintFeeController::class);
        // Route::resource('receipts', ReceiptController::class);

        // Route::resource('attendance', AttendanceController::class);
        // Route::resource('subject', SubjectController::class);
        // Route::resource('quizz', QuizzController::class);
        // Route::resource('question', QuestionController::class);

        // Route::get('online_classes', [OnlineClassController::class, 'index'])->name('online_classes.index');
        // Route::get('online_classes/direct', [OnlineClassController::class, 'direct'])->name('online_classes.direct');
        // Route::get('online_classes/indirect', [OnlineClassController::class, 'indirect'])->name('online_classes.indirect');
        // Route::post('online_classes/storeDirect', [OnlineClassController::class, 'storeDirect'])->name('online_classes.storeDirect');
        // Route::post('online_classes/storeIndirect', [OnlineClassController::class, 'storeIndirect'])->name('online_classes.storeIndirect');
        // Route::post('online_classes/{id}/destroy', [OnlineClassController::class, 'destroy'])->name('online_classes.destroy');


    });


