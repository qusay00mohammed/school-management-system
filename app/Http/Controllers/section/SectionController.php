<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('section', Section::class);
        $stage = Stage::with('sections')->get();
        $teachers = Teacher::all();
        return view('pages.section.section')->with(compact('stage', 'teachers'));
    }

    public function filter_grade_by_stage($id)
    {
        $grade = Grade::where('stage_id', $id)->pluck('name', 'id');
        // $grade = Grade::select('name', 'id')->where('stage_id', $id)->get();
        return response()->json([
            'grade' => $grade,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $this->authorize('add section', Section::class);
            $request->validate([
                "name_ar" => "required",
                "name_en" => "required",
                "grade_id" => "required",
                "stage_id" => "required",
                "teacher_id" => "required",
            ]);
            $section = new Section();
            $section->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $section->grade_id = $request->grade_id;
            $section->save();

            $section->teachers()->sync($request->teacher_id);

            // toastr()->success(__('trans_notification.saved'));
            return redirect()->route('section.index')->with('success', __('trans_notification.saved'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
            $this->authorize('edit section', Section::class);
            $request->validate([
                "name_ar" => "required",
                "name_en" => "required",
                "grade_id" => "required",
                "stage_id" => "required",
                "status" => "required",
                "teacher_id" => "required",
            ]);

            $section->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $section->grade_id = $request->grade_id;
            if ($request->status == 0) {
                $section->status = 0;
            }else {
                $section->status = 1;
            }
            $section->save();
            $section->teachers()->sync($request->teacher_id);

            // toastr()->success(__('trans_notification.edited'));
            return redirect()->route('section.index')->with('success', __('trans_notification.edited'));
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error', $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $this->authorize('delete section', Section::class);
        $section->delete();
        // toastr()->success(__('trans_notification.deleted'));
        return redirect()->route('section.index')->with('warning', __('trans_notification.deleted'));
    }
}
