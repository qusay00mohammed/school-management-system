<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = $this->teacher->getTeachers();
        return view('pages.teacher.teacher',compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializations = $this->teacher->getSpecialization();
        $gender = $this->teacher->getGender();
        return view('pages.teacher.create',compact('specializations','gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->teacher->storeTeacher($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $specializations = $this->teacher->getSpecialization();
        $gender = $this->teacher->getGender();
        return view('pages.teacher.edit', compact('teacher', 'specializations', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        return $this->teacher->updateTeacher($request, $teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        return $this->teacher->deleteTeacher($teacher);
    }
}
