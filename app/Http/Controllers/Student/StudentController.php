<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadAttachmentTrait;
use App\Models\BloodType;
use App\Models\FileAttachment;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Student;
use App\Models\TheParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    use UploadAttachmentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('pages.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalities = Nationality::all();
        $gender = Gender::all();
        $bloodType = BloodType::all();
        $stage = Stage::all();
        $parent = TheParent::all();
        return response()->view('pages.student.add', compact('nationalities', 'gender', 'bloodType', 'stage', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
           'name_ar' => 'required',
           'name_en' => 'required',
           'email' => 'required|email|unique:students,email',
           'password' => 'required|string|min:6',
           'gender_id' => 'required',
           'nationality_id' => 'required',
           'bloodType_id' => 'required',
           'date_birthday' => 'required|date|date_format:Y-m-d',
           'section_id' => 'required',
           'parent_id' => 'required',
           'academic_year' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $student = new Student();
            $student->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->academic_year = $request->academic_year;
            $student->gender_id = $request->gender_id;
            $student->nationality_id = $request->nationality_id;
            $student->bloodType_id = $request->bloodType_id;
            $student->date_birthday = $request->date_birthday;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->save();
            if($request->hasfile('files'))
            {
                // insert img
                $this->uploadFile($request, 'students', $student);
            }
            DB::commit(); // insert data
            // toastr()->success(__('trans_notification.saved'));
            return redirect()->route('students.index')->with('success', __('trans_notification.saved'));

        }

        catch (\Exception $e){
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
        $student = Student::findOrFail($id);
        return view('pages.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $nationalities = Nationality::all();
        $gender = Gender::all();
        $bloodType = BloodType::all();
        $stage = Stage::all();
        $parent = TheParent::all();
        return response()->view('pages.student.edit', compact('student', 'nationalities', 'gender', 'bloodType', 'stage', 'parent'));
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
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'bloodType_id' => 'required',
            'date_birthday' => 'required|date|date_format:Y-m-d',
            'section_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required',
        ]);

        try {
            $student = Student::findOrFail($id);
            $student->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $student->email = $request->email;
            $student->academic_year = $request->academic_year;
            $student->gender_id = $request->gender_id;
            $student->nationality_id = $request->nationality_id;
            $student->bloodType_id = $request->bloodType_id;
            $student->date_birthday = $request->date_birthday;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            if (isset($request->password))
            {
                $student->password = Hash::make($request->password);
            }
            $student->save();

            // toastr()->success(__('trans_notification.saved'));
            return redirect()->route('students.index')->with('success', __('trans_notification.edited'));
        }
        catch (\Exception $e){
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
        $student = Student::findOrFail($id)->delete();
        if($student)
        {
            // toastr()->success(__('trans_notification.deleted'));
            return response()->redirectToRoute('students.index')->with('warning', __('trans_notification.deleted'));
        }
    }


//    Get sections
    public function filter_section_by_grade($id)
    {
        $sections = Section::where('grade_id', $id)->pluck('name', 'id');
        return response()->json([
            'sections' => $sections,
        ], 200);
    }

    public function uploadAttachment(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        // insert img

        $this->uploadFile($request, 'students', $student);

        return redirect()->back()->with('success', __('trans_notification.edited'));
    }



    public function downloadAttachment($attachment_id, $student_id)
    {
        $student = Student::findOrFail($student_id);
        $email = $student->email;

        $attachment = FileAttachment::select('filename')->where('id', $attachment_id)->first();
        $name = $attachment->filename;

        return response()->download(public_path("storage/attachments/students/$email/$name"));
    }


    public function deleteAttachment($attachment_id, $student_id)
    {
        // delete from server
        $student = Student::findOrFail($student_id);
        $email = $student->email;

        $attachment = FileAttachment::findOrFail($attachment_id);
        $name = $attachment->filename;

        $attachment = $attachment->delete();
        Storage::disk('public')->delete('attachments/students/' .$email. '/' . $name);
        return redirect()->back()->with('warning', __('trans_notification.deleted'));
    }


}
