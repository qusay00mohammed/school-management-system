<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use App\Models\Exchequer;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = Receipt::all();
        return view('pages.receipt.index', compact('receipts'));
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
            // حفظ البيانات في جدول سندات الصرف
            $receipt = new Receipt();
            $receipt->date = date('Y-m-d');
            $receipt->student_id = $request->student_id;
            $receipt->amount = $request->receipt;
            $receipt->note = $request->note;
            $receipt->save();

            // حفظ البيانات في جدول الصندوق
            $exchequer = new Exchequer();
            $exchequer->date = date('Y-m-d');
            $exchequer->receipt_id = $receipt->id;
            $exchequer->debit = 0.00;
            $exchequer->credit = $request->receipt;
            $exchequer->note = $request->note;
            $exchequer->save();

            // حفظ البيانات في جدول حساب الطلاب
            $students_fee = new StudentFee();
            $students_fee->date = date('Y-m-d');
            $students_fee->type = 'Receipt';
            $students_fee->student_id = $request->student_id;
            $students_fee->receipt_id = $receipt->id;
            $students_fee->debit = $request->receipt;
            $students_fee->credit = 0.00;
            $students_fee->note = $request->note;
            $students_fee->save();

            DB::commit();
            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('receipts.index')->with('success', __('trans_notification.saved'));

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
        return view('pages.receipt.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receipt = Receipt::findorfail($id);
        return view('pages.receipt.edit', compact('receipt'));
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
            // حفظ البيانات في جدول سندات الصرف
            $receipt = Receipt::findorfail($id);
            $receipt->date = date('Y-m-d');
            $receipt->student_id = $request->student_id;
            $receipt->amount = $request->receipt;
            $receipt->note = $request->note;
            $receipt->save();

            // حفظ البيانات في جدول الصندوق
            $exchequer = Exchequer::where('receipt_id', $id)->first();
            $exchequer->date = date('Y-m-d');
            $exchequer->receipt_id = $receipt->id;
            $exchequer->debit = 0.00;
            $exchequer->credit = $request->receipt;
            $exchequer->note = $request->note;
            $exchequer->save();

            // حفظ البيانات في جدول حساب الطلاب
            $students_fee = StudentFee::where('receipt_id', $id)->first();
            $students_fee->date = date('Y-m-d');
            $students_fee->type = 'Receipt';
            $students_fee->student_id = $request->student_id;
            $students_fee->receipt_id = $receipt->id;
            $students_fee->debit = $request->receipt;
            $students_fee->credit = 0.00;
            $students_fee->note = $request->note;
            $students_fee->save();

            DB::commit();
            // toastr()->success(trans('trans_notification.edited'));
            return redirect()->route('receipts.index')->with('success', __('trans_notification.edited'));

        } catch (\Exception $e) {
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
            Receipt::findOrFail($id)->delete();
            // toastr()->success(trans('trans_notification.deleted'));
            return redirect()->route('receipts.index')->with('warning', __('trans_notification.deleted'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
