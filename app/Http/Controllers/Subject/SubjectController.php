<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::get();
        return view('pages.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stage = Stage::get();
        $teachers = Teacher::get();
        return view('pages.subject.add', compact('stage','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $subject = new Subject();
            $subject->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subject->grade_id = $request->grade_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->save();
            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('subject.index')->with('success', __('trans_notification.saved'));
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
        $subject =Subject::findorfail($id);
        $stage = Stage::get();
        $teachers = Teacher::get();
        return view('pages.subject.edit', compact('subject','stage','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subject->grade_id = $request->grade_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->save();
            // toastr()->success(trans('trans_notification.edited'));
            return redirect()->route('subject.index')->with('success', __('trans_notification.edited'));
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Subject::destroy($id);
            // toastr()->error(trans('trans_notification.deleted'));
            return redirect()->route('subject.index')->with('warning', __('trans_notification.deleted'));
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
