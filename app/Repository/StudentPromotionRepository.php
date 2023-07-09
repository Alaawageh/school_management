<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface{
    public function index(){
        $grades = Grade::all();
        return view('pages.Students.Promotion.index',compact('grades'));
    }
    public function store($request){
        DB::beginTransaction();
    try{
        $students = Student::where('grade_id',$request->grade_id)->where('class_id',$request->class_id)->where('section_id',$request->section_id)->get();
        if($students->count() >= 1){
            foreach($students as $student){
                $ids = explode(',',$student->id);
                Student::whereIn('id',$ids)->update([
                    'grade_id' => $request->grade_id_new,
                    'class_id' => $request->class_id_new,
                    'section_id' => $request->section_id_new,
                ]);
                promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_class' => $request->class_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->grade_id_new,
                    'to_class' => $request->class_id_new,
                    'to_section' => $request->section_id_new,
                ]);
            }
        }
        DB::commit();
        toastr()->success(trans('message.Added'));
        return redirect()->route('Students.index');
    }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
        
    }
}