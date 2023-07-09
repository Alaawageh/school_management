<?php
namespace App\Repository;

interface TeacherRepositoryInterface{

    public function GetAllTeachers();

    public function Getspecializations();

    public function GetGender();

    public function StoreTeacher($request);

    public function Edit($id);

    public function UpdateTeacher($request);

    public function DeleteTeacher($request);

}