<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudent;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }
    public function index()
    {
        return $this->Student->ListStudent();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Student->CreateStudent();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudent $request)
    {
        return $this->Student->StoreStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Student->ShowStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Student->EditStudent($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudent $request)
    {
        return $this->Student->UpdateStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Student->DeleteStudent($request);
    }
     public function getClasses($id)
     {
        return $this->Student->getClasses($id);
     }
     public function getSections($id)
     {
        return $this->Student->getSections($id);
     }
     public function Upload_attachment(Request $request){
        return $this->Student->Upload_attachment($request);
     }
     public function Download_attachment($student_name,$file_name){
       return $this->Student->Download_attachment($student_name,$file_name); 
     }
     public function Delete_attachment(Request $request){
        return $this->Student->Delete_attachment($request);
     }
}
