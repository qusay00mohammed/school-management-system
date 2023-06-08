<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Stage;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeInvoiceController extends Controller
{
    public function index()
    {
        $fee_invoices = FeeInvoice::all();
        $stage = Stage::all();
        return view('pages.fee_invoices.index', compact('fee_invoices', 'stage'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        $fees = Fee::where('grade_id', $student->section->grade->id)->get();
        return view('pages.fee_invoices.add', compact('student', 'fees'));
    }

    public function store(Request $request)
    {
        $list_fee = $request->List_Fees;
        // dd($request->all());
        DB::beginTransaction();
        try {
            foreach ($list_fee as $fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $saveFee = new FeeInvoice();
                $saveFee->invoice_date = date('Y-m-d');
                $saveFee->student_id = $fee['student_id'];
                $saveFee->grade_id = $request->grade_id;
                $saveFee->fee_id = $fee['fee_id'];
                $saveFee->amount = $fee['amount'];
                $saveFee->note = $fee['note'];
                $saveFee->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentFee = new StudentFee();
                $StudentFee->date = date('Y-m-d');
                $StudentFee->type = 'invoice';
                $StudentFee->fee_invoice_id = $saveFee->id; ///
                $StudentFee->student_id = $fee['student_id'];
                $StudentFee->debit = $fee['amount'];
                $StudentFee->credit = 0.00;
                $StudentFee->note = $fee['note'];
                $StudentFee->save();
            }
            DB::commit();

            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('fee_invoices.index')->with('success', __('trans_notification.saved'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee_invoice = FeeInvoice::findorfail($id);
        $fees = Fee::where('grade_id', $fee_invoice->grade_id)->get();
        return view('pages.fee_invoices.edit', compact('fee_invoice', 'fees'));
    }



    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $fee = FeeInvoice::findorfail($id);
            $fee->fee_id = $request->fee_id;
            $fee->amount = $request->amount;
            $fee->note = $request->note;
            $fee->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $studentFee = StudentFee::where('fee_invoice_id', $id)->first();
            $studentFee->debit = $request->amount;
            $studentFee->note = $request->note;
            $studentFee->save();
            DB::commit();

            // toastr()->success(trans('trans_notification.updated'));
            return redirect()->route('fee_invoices.index')->with('success', __('trans_notification.edited'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            FeeInvoice::findOrFail($id)->delete();
            // toastr()->error(trans('trans_notification.deleted'));
            return redirect()->back()->with('warning', __('trans_notification.saved'));
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
