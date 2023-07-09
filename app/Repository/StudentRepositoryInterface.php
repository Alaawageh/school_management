<?php
namespace App\Repository;

interface StudentRepositoryInterface{
    
    public function CreateStudent();
    public function getClasses($id);
    public function getSections($id);
    public function StoreStudent($request);
    public function ListStudent();
    public function EditStudent($id);
    public function UpdateStudent($request);
    public function DeleteStudent($request);
    public function ShowStudent($id);
    public function Upload_attachment($request);
    public function Download_attachment($student_name,$file_name);
    public function Delete_attachment($request);
}