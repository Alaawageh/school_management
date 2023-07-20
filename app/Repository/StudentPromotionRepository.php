<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface{

    public function index(){
        $grades = Grade::all();
        return view('pages.Students.Promotion.index',compact('grades'));
    }
    public function store($request){
        DB::beginTransaction();
    try{
        $students = Student::where('grade_id',$request->grade_id)->where('class_id',$request->class_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
        if($students->count() >= 1){
            foreach($students as $student){
                $ids = explode(',',$student->id);
                Student::whereIn('id',$ids)->update([
                    'grade_id' => $request->grade_id_new,
                    'class_id' => $request->class_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year' => $request->academic_year_new
                ]);
                promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_class' => $request->class_id,
                    'from_section' => $request->section_id,
                    'academic_year' => $request->academic_year,
                    'to_grade' => $request->grade_id_new,
                    'to_class' => $request->class_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year_new' => $request->academic_year_new
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
    public function create(){
        $promotions = promotion::all();
        return view('pages.Students.Promotion.management',compact('promotions'));
    }
    public function destroy($request){
        DB::beginTransaction();
        try{
            if($request->page_id == 1){
                $promotions = promotion::all();
                foreach($promotions as $promotion){
    
                    $ids = explode(',',$promotion->student_id);
                    Student::whereIn('id',$ids)->update([
                        'grade_id' => $promotion->from_grade,
                        'class_id' => $promotion->from_class,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year,
                    ]);
                    promotion::truncate();
    
                }
                DB::commit();
                toastr()->error(trans('message.Delete'));
                return redirect()->back();
            }else{
                $promotion = promotion::findorfail($request->id);
                student::where('id', $promotion->student_id)
                    ->update([
                        'grade_id'=>$promotion->from_grade,
                        'class_id'=>$promotion->from_class,
                        'section_id'=> $promotion->from_section,
                        'academic_year'=>$promotion->academic_year,
                    ]);


                promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('message.Delete'));
                return redirect()->back();

            }
        }
        catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}