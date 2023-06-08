<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuizzeController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->user()->id)->get();
        return view('pages.teacher.dashboard.quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $data['stage'] = Stage::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        // $data['teachers'] = Teacher::all();

        return view('pages.teacher.dashboard.quizzes.add', $data);
    }


    public function store(Request $request)
    {
        try {
            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizzes->subject_id = $request->subject_id;
            // $quizzes->grade_id = $request->Grade_id;
            // $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();
            return redirect()->route('teacher.quizze.index')->with('success', __('trans_notification.saved'));
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizze::findOrFail($id);
        return view('pages.teacher.dashboard.questions.index', compact('questions','quizz'));
    }



    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['stage'] = Stage::all();
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        return view('pages.teacher.dashboard.quizzes.edit', $data, compact('quizz'));
    }




    public function update(Request $request)
    {
        try {
            $quizz = Quizze::findorFail($request->id);
            $quizz->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizz->subject_id = $request->subject_id;
            // $quizz->grade_id = $request->Grade_id;
            // $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();
            return redirect()->route('teacher.quizze.index')->with('success', __('trans_notification.edited'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            Quizze::destroy($id);
            return redirect()->back()->with('warning', __('trans_notification.deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
