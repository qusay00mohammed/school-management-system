<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use App\Models\CatchReceipt;
use App\Models\Exchequer;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatchReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catch_receipt = CatchReceipt::all();
        return view('pages.catch_receipt.index', compact('catch_receipt'));
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
            // حفظ البيانات في جدول سندات القبض
            $catchReceipt = new CatchReceipt();
            $catchReceipt->date = date('Y-m-d');
            $catchReceipt->student_id = $request->student_id;
            $catchReceipt->debit = $request->exchequer;
            $catchReceipt->note = $request->note;
            $catchReceipt->save();

            // حفظ البيانات في جدول الصندوق
            $exchequer = new Exchequer();
            $exchequer->date = date('Y-m-d');
            $exchequer->catch_receipt_id = $catchReceipt->id;
            $exchequer->debit = $request->exchequer;
            $exchequer->credit = 0.00;
            $exchequer->note = $request->note;
            $exchequer->save();

            // حفظ البيانات في جدول حساب الطالب
            $studentFee = new StudentFee();
            $studentFee->date = date('Y-m-d');
            $studentFee->type = 'exchequer';

            $studentFee->catch_receipt_id = $catchReceipt->id;

            $studentFee->student_id = $request->student_id;
            $studentFee->debit = 0.00;
            $studentFee->credit = $request->exchequer;
            $studentFee->note = $request->note;
            $studentFee->save();

            DB::commit();
            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('catchReceipts.index')->with('success', __('trans_notification.saved'));

        }

        catch (\Exception $e) {
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
        return view('pages.catch_receipt.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catch_receipt = CatchReceipt::findorfail($id);
        return view('pages.catch_receipt.edit', compact('catch_receipt'));
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
            // حفظ البيانات في جدول سندات القبض
            $catchReceipt = CatchReceipt::findOrFail($id);
            $catchReceipt->date = date('Y-m-d');
            $catchReceipt->student_id = $request->student_id;
            $catchReceipt->debit = $request->exchequer;
            $catchReceipt->note = $request->note;
            $catchReceipt->save();

            // حفظ البيانات في جدول الصندوق
            $exchequer = Exchequer::where('catch_receipt_id', $id)->first();
            $exchequer->date = date('Y-m-d');
            $exchequer->catch_receipt_id = $catchReceipt->id;
            $exchequer->debit = $request->exchequer;
            $exchequer->credit = 0.00;
            $exchequer->note = $request->note;
            $exchequer->save();

            // حفظ البيانات في جدول حساب الطالب
            $studentFee = StudentFee::where('catch_receipt_id', $id)->first();
            $studentFee->date = date('Y-m-d');
            $studentFee->type = 'exchequer';

            $studentFee->catch_receipt_id = $catchReceipt->id;

            $studentFee->student_id = $request->student_id;
            $studentFee->debit = 0.00;
            $studentFee->credit = $request->exchequer;
            $studentFee->note = $request->note;
            $studentFee->save();

            DB::commit();
            // toastr()->success(trans('trans_notification.edited'));
            return redirect()->route('catchReceipts.index')->with('success', __('trans_notification.saved'));

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
            CatchReceipt::findOrFail($id)->delete();
            // toastr()->success(trans('trans_notification.deleted'));
            return redirect()->route('catchReceipts.index')->with('warning', __('trans_notification.deleted'));
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
