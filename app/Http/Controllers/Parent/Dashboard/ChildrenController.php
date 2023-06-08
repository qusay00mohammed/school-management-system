<?php

namespace App\Http\Controllers\Parent\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\FeeInvoice;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TheParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.children.index', compact('students'));
    }

    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            return redirect()->route('sons.index')->with('warning', __('trans_notification.error in student code'));
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            return redirect()->route('sons.index')->with('warning', __('trans_notification.no results for student'));
        }

        return view('pages.parent.degree.index', compact('degrees'));
    }


    public function attendances()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.attendance.index', compact('students'));
    }

    public function attendanceSearch(Request $request)
    {

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);


        $students = Student::where('parent_id', auth()->user()->id)->get();

        if ($request->student_id == 0) {

            $results = Attendance::whereBetween('date', [$request->from, $request->to])->get();
            return view('pages.parent.attendance.index', compact('results', 'students'));
        } else {

            $results = Attendance::whereBetween('date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parent.attendance.index', compact('results', 'students'));
        }

    }




    public function fees(){
        $student_id = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $fees = FeeInvoice::whereIn('student_id', $student_id)->get();
        return view('pages.parent.fee.index', compact('fees'));
    }

    public function receiptStudent($id){

        $student = Student::findOrFail($id);
        if ($student->parent_id != auth()->user()->id) {
            return redirect()->route('sons.fees')->with('warning', __('trans_notification.error in student code'));
        }

        $receipts = Receipt::where('student_id', $id)->get();

        if ($receipts->isEmpty()) {
            return redirect()->route('sons.fees')->with('warning', __('trans_notification.no payment for student'));
        }

        return view('pages.parent.receipt.index', compact('receipts'));

    }


    public function profile()
    {
        $information = TheParent::findOrFail(auth()->user()->id);
        return view('pages.parent.profile.index', compact('information'));
    }

    public function update(Request $request, $id)
    {

        $information = TheParent::findOrFail($id);

        if (!empty($request->password)) {
            $information->father_name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->father_name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $information->save();
        }
        return redirect()->back()->with('warning', __('trans_notification.edited'));


    }

}
