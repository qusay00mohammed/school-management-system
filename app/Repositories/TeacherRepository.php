<?php

namespace App\Repositories;

use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface {

    public function getTeachers()
    {
        return Teacher::all();
    }

    public function getSpecialization()
    {
        return Specialization::all();
    }

    public function getGender()
    {
        return Gender::all();
    }

    public function storeTeacher($request)
    {
        $request->validate([
            "email" => "required|unique:teachers,email",
            "password" => "required",
            "name_ar" => "required",
            "name_en" => "required",
            "specialization_id" => "required",
            "gender_id" => "required",
            "joining_date" => "required",
            "address" => "required",
        ]);

        try {
            $teacher = new Teacher();
            $teacher->email = $request->email;
            $teacher->password =  Hash::make($request->password);
            $teacher->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();
            // toastr()->success(__('trans_notification.saved'));
            return redirect()->route('teachers.create')->with('success', __('trans_notification.saved'));

        }catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function updateTeacher($request, $teacher)
    {
        $request->validate([
            "email" => "required|unique:teachers,email," . $teacher->id,
            "name_ar" => "required",
            "name_en" => "required",
            "specialization_id" => "required",
            "gender_id" => "required",
            "joining_date" => "required",
            "address" => "required",
        ]);

        try {
            if(isset($teacher->password))
            {
                $teacher->password =  Hash::make($request->password);
            }
            $teacher->email = $request->email;
            $teacher->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();
            // toastr()->success(__('trans_notification.saved'));
            return redirect()->route('teachers.index')->with('success', __('trans_notification.edited'));

        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function deleteTeacher($teacher)
    {
        $teacher->delete();
        // toastr()->success(__('trans_notification.deleted'));
        return redirect()->route('teachers.index')->with('warning', __('trans_notification.deleted'));
    }
}
