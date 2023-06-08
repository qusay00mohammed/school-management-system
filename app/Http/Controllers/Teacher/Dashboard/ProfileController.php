<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Teacher::findorFail(auth()->user()->id);
        return view('pages.teacher.dashboard.profile.index', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = Teacher::findorFail($id);

        if (!empty($request->password)) {
            $information->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $information->save();
        }
        return redirect()->back()->with('success', __('trans_notification.saved'));
    }
}
