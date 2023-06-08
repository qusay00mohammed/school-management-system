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
use App\Http\Controllers\Parent\Dashboard\ChildrenController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quizz\QuizzController;
use App\Http\Controllers\Subject\SubjectController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Parent Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/parent',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent' ]
    ], function(){

        Route::get('/dashboard', function () {
            $sons = Student::where('parent_id', auth()->user()->id)->get();
            return view('pages.parent.dashboard', compact('sons'));
        })->name('parent.dashboard');


        Route::get('children', [ChildrenController::class, 'index'])->name('sons.index');
        Route::get('results/{id}', [ChildrenController::class, 'results'])->name('sons.results');
        Route::get('attendances', [ChildrenController::class, 'attendances'])->name('sons.attendances');
        Route::post('attendances', [ChildrenController::class, 'attendanceSearch'])->name('sons.attendance.search');
        Route::get('fees', [ChildrenController::class, 'fees'])->name('sons.fees');
        Route::get('receipt/{id}', [ChildrenController::class, 'receiptStudent'])->name('sons.receipt');

        Route::get('profile', [ChildrenController::class, 'profile'])->name('profile.show.parent');
        Route::post('profile/{id}', [ChildrenController::class, 'update'])->name('profile.update.parent');




        // Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('home');

        // Route::resource('stage', StageController::class);

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


