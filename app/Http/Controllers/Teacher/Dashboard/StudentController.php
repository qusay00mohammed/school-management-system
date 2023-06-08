<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function students()
    {
        $sections_id = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
        $sections = Section::whereIn('id', $sections_id)->get();
        // $students = Student::whereIn('section_id', $sections_id)->get();

        return view('pages.teacher.dashboard.students.index', compact('sections'));
    }

    public function sections()
    {
        $sections_id = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
        $sections = Section::whereIn('id', $sections_id)->get();

        return view('pages.teacher.dashboard.sections.index', compact('sections'));
    }

    public function attendences(Request $request, $id)
    {

        try {
            $attenddate = date('Y-m-d');
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentid,
                        'date' => $attenddate
                    ],
                    [
                    'student_id' => $studentid,
                    // 'grade_id' => $request->grade_id,
                    // 'classroom_id' => $request->classroom_id,
                    'section_id' => $id,
                    'teacher_id' => auth()->user()->id,
                    'date' => $attenddate,
                    'status' => $attendence_status
                ]);
            }
            return redirect()->back()->with('success', __('trans_notification.saved'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // public function editAttendance(Request $request)
    // {

    //     try {
    //         $date = date('Y-m-d');
    //         $student_id = Attendance::where('attendence_date', $date)->where('student_id', $request->id)->first();
    //         if ($request->attendences == 'presence') {
    //             $attendence_status = true;
    //         } else if ($request->attendences == 'absent') {
    //             $attendence_status = false;
    //         }
    //         $student_id->update([
    //             'attendence_status' => $attendence_status
    //         ]);
    //         toastr()->success(trans('messages.success'));
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }

    // }

    public function attendences_report()
    {
        $sections_id = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
        // $sections = Section::whereIn('id', $sections_id)->get();
        $students = Student::whereIn('section_id', $sections_id)->get();

        // $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        // $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.teacher.dashboard.students.attendance_search', compact('students'));
    }

    public function attendences_search(Request $request)
    {

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);


        $sections_id = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
        $students = Student::whereIn('section_id', $sections_id)->get();

        if ($request->student_id == 0) {

            $results = Attendance::whereBetween('date', [$request->from, $request->to])->get();
            return view('pages.teacher.dashboard.students.attendance_search', compact('results', 'students'));
        } else {

            $results = Attendance::whereBetween('date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.teacher.dashboard.students.attendance_search', compact('results', 'students'));


        }


    }
}
