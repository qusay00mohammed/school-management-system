<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Stage;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(){
        $fees = Fee::all();
        return view('pages.fee.index', compact('fees'));
    }

    public function create(){
        $stage = Stage::all();
        return view('pages.fee.add', compact('stage'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'amount' => 'required',
            'stage_id' => 'required',
            'grade_id' => 'required',
            'academic_year' => 'required',
            'fee_type' => 'required',
        ]);

        try {
            $fees = new Fee();
            $fees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $fees->amount  =$request->amount;
            $fees->grade_id  =$request->grade_id;
            $fees->note  =$request->note;
            $fees->academic_year  =$request->academic_year;
            $fees->fee_type  =$request->fee_type;
            $fees->save();

            // toastr()->success(trans('trans_notification.saved'));
            return redirect()->route('fees.create')->with('success', __('trans_notification.saved'));
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $fee = Fee::findorfail($id);
        $stage = Stage::all();
        return view('pages.fee.edit',compact('fee','stage'));
    }




    public function update(Request $request ,$id)
    {
        $fee = Fee::findOrFail($id);
        $request->validate([
            'name_ar'       => 'required',
            'name_en'       => 'required',
            'amount'        => 'required',
            'stage_id'      => 'required',
            'grade_id'      => 'required',
            'academic_year' => 'required',
            'fee_type'      => 'required',
        ]);

        try {
            $fee->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $fee->amount  =$request->amount;
            $fee->grade_id  =$request->grade_id;
            $fee->note  =$request->note;
            $fee->academic_year  =$request->academic_year;
            $fee->fee_type  =$request->fee_type;
            $fee->save();

            // toastr()->success(trans('trans_notification.updated'));
            return redirect()->route('fees.index')->with('success', __('trans_notification.edited'));
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $fee = Fee::findOrFail($id)->delete();
            if($fee)
            {
                // toastr()->error(trans('trans_notification.deleted'));
                return redirect()->back()->with('warning', __('trans_notification.saved'));
            }
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
