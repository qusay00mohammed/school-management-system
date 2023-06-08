<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnlineClass;
use App\Models\Subject;
use App\Models\Section;
use Auth;

class ClassOnlineController extends Controller
{
    public function index()
    {
        $section_id_for_user =  Auth::user()->section_id;
        $online_classes = OnlineClass::where(['section_id' => $section_id_for_user])->get();

        return view('pages.student.dashboard.online_classes.index', compact('online_classes'));
    }

    public function subject()
    {
        $section_id_for_user =  Auth::user()->section_id;
        $grade_id_for_user = Section::findOrfail($section_id_for_user)->grade_id;
        $subjects = Subject::where(['grade_id' => $grade_id_for_user])->get();
        return view('pages.student.dashboard.subject.index', compact('subjects'));
    }
}
