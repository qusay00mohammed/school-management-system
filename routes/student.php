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
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quizz\QuizzController;
use App\Http\Controllers\Student\ChatGPT\ChatGPTController;
use App\Http\Controllers\Student\Dashboard\ExamController;
use App\Http\Controllers\Student\Dashboard\ProfileController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Student\Dashboard\ClassOnlineController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/student',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student' ]
    ], function(){

        Route::get('/dashboard', function () {
            return view('pages.student.dashboard.dashboard');
        })->name('student.dashboard');



        Route::get('exams', [ExamController::class, "index"])->name('student.exam.index');
        Route::get('question-show/{id}', [ExamController::class, "show"])->name('student.exam.show');
        // Route::resource('exams', ExamController::class);
        Route::get('profile', [ProfileController::class, "index"])->name('student.profile.index');
        Route::post('profile/{id}', [ProfileController::class, "update"])->name('student.profile.update');


        Route::get('questions', [ChatGPTController::class, 'index'])->name('student.questions.index');
        Route::post('questions', [ChatGPTController::class, 'store'])->name('student.questions.store');
        Route::get('reset', [ChatGPTController::class, 'destroy'])->name('student.questions.reset');

        Route::get('online_classes', [ClassOnlineController::class, 'index'])->name('student.online_classes.index');
        Route::get('subject', [ClassOnlineController::class, 'subject'])->name('student.subject.index');

        // Route::resource('stage', StageController::class);

        // Route::resource('grade', GradeController::class);
        // Route::post('delete_all_item', [GradeController::class, "delete_all_item"])->name('delete_all_item');
        // Route::post('filter_grade', [GradeController::class, "filter_grade"])->name('filter_grade');

        // Route::resource('section', SectionController::class);

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


