<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface {

    public function getTeachers();

    public function getSpecialization();

    public function getGender();

    public function storeTeacher($request);

    public function updateTeacher($request, $teacher);

    public function deleteTeacher($id);
}
