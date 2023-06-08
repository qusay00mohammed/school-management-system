<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessintFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processing_fees = ProcessingFee::all();
        return view('pages.processing_fee.index', compact('processing_fees'));
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
            DB::beginTransaction();
            // حفظ البيانات في جدول معالجة الرسوم
            $process_fee = new ProcessingFee();
            $process_fee->date = date('Y-m-d');
            $process_fee->student_id = $request->student_id;
            $process_fee->amount = $request->process;
            $process_fee->note = $request->note;
            $process_fee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_fee = new StudentFee();
            $students_fee->date = date('Y-m-d');
            $students_fee->type = 'ProcessingFee';
            $students_fee->student_id = $request->student_id;
            $students_fee->processing_fee_id = $process_fee->id;
            $students_fee->debit = 0.00;
            $students_fee->credit = $request->process;
            $students_fee->note = $request->note;
            $students_fee->save();

            DB::commit();
            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('processingFees.index')->with('success', __('trans_notification.saved'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
        $student = Student::findorfail($id);
        return view('pages.processing_fee.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $processingFee = ProcessingFee::findorfail($id);
        return view('pages.processing_fee.edit', compact('processingFee'));
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
            DB::beginTransaction();
            // حفظ البيانات في جدول معالجة الرسوم
            $process_fee = ProcessingFee::findOrfail($id);
            $process_fee->date = date('Y-m-d');
            $process_fee->student_id = $request->student_id;
            $process_fee->amount = $request->process;
            $process_fee->note = $request->note;
            $process_fee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_fee = StudentFee::where('processing_fee_id', $id)->first();
            $students_fee->date = date('Y-m-d');
            $students_fee->type = 'ProcessingFee';
            $students_fee->student_id = $request->student_id;
            $students_fee->processing_fee_id = $process_fee->id;
            $students_fee->debit = 0.00;
            $students_fee->credit = $request->process;
            $students_fee->note = $request->note;
            $students_fee->save();

            DB::commit();
            // toastr()->success(trans('trans_notification.edited'));
            return redirect()->route('processingFees.index')->with('success', __('trans_notification.edited'));

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
            ProcessingFee::findOrFail($id)->delete();
            // toastr()->success(trans('trans_notification.deleted'));
            return redirect()->route('processingFees.index')->with('warning', __('trans_notification.deleted'));
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
