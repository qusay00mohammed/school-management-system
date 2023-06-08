<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Stage;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stage = Stage::all();
        return view('pages.student.promotion.index', compact('stage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();
        return view('pages.student.promotion.management', compact('promotions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            "stage_id" => 'required',
            "grade_id" => 'required',
            "section_id" => 'required',
            "academic_year" => 'required',
            "stage_id_new" => 'required',
            "grade_id_new" => 'required',
            "section_id_new" => 'required',
            "academic_year_new" => 'required',
        ]);

        DB::beginTransaction();
        try {
            $students = Student::where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error', __('trans_student.no data'));
            }

            // update in table student
            foreach ($students as $student) {
                Student::where('id', $student->id)->update([
                    'section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year_new,
                ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_section_id' => $request->section_id,
                    'to_section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('promotion.index')->with('success', __('trans_notification.saved'));
        } catch (\Exception $e) {
            DB::rollback();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            if ($id == "back") {
                $promotions = Promotion::all();
                foreach ($promotions as $promotion) {
                    Student::where('id', $promotion->student_id)->update([
                        'section_id' => $promotion->from_section_id,
                        'academic_year' => $promotion->academic_year,
                    ]);
                    Promotion::truncate();
                }
                DB::commit();
                // toastr()->error(trans('trans_notification.deleted'));
                return redirect()->back()->with('warning', __('trans_notification.deleted'));
            } else {

                $promotion = Promotion::findOrFail($id);
                Student::where('id', $promotion->student_id)->update([
                    'section_id' => $promotion->from_section_id,
                    'academic_year' => $promotion->academic_year,
                ]);

                $promotion::destroy($id);
                DB::commit();
                // toastr()->error(trans('trans_notification.deleted'));
                return redirect()->back()->with('warning', __('trans_notification.deleted'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
