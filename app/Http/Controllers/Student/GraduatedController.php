<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stage;
use App\Models\Student;

class GraduatedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.student.graduated.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stage = Stage::all();
        return view('pages.student.graduated.create', compact('stage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = student::where('section_id',$request->section_id)->get();
        if($students->count() < 1){
            return redirect()->back()->with('error_graduated', __('trans_student.no data'));
        }
        foreach ($students as $student){
            student::where('id', $student->id)->delete();
        }
        // toastr()->success(trans('trans.notification.saved'));
        return redirect()->route('graduated.index')->with('success', __('trans_notification.saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        Student::onlyTrashed()->findOrFail($id)->restore();
        // toastr()->error(trans('trans_notification.edited'));
        return redirect()->back()->with('success', __('trans_notification.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::onlyTrashed()->findOrFail($id)->forceDelete();
        // toastr()->error(trans('trans_notification.deleted'));
        return redirect()->back()->with('warning', __('trans_notification.deleted'));
    }
}
