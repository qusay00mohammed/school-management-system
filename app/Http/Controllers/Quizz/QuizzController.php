<?php

namespace App\Http\Controllers\Quizz;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quizze::get();
        return view('pages.quizz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['stage'] = Stage::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.quizz.add', $data);
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
            $quizze = new Quizze();
            $quizze->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizze->subject_id = $request->subject_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = $request->teacher_id;
            $quizze->save();
            return redirect()->route('quizz.index')->with('success', __('trans_notification.saved'));
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
        $quizz = Quizze::findorFail($id);
        $data['stage'] = Stage::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.quizz.edit', $data, compact('quizz'));
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
            $quizze = Quizze::findorFail($id);
            $quizze->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizze->subject_id = $request->subject_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = $request->teacher_id;
            $quizze->save();
            return redirect()->route('quizz.index')->with('success', __('trans_notification.edited'));
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
            Quizze::destroy($id);
            // toastr()->error(trans('trans_notification.deleted'));
            return redirect()->back()->with('warning', __('trans_notification.deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
