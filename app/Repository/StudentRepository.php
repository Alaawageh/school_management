<?php
namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface{
 
    public function CreateStudent(){
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();
        $data['religions'] = Religion::all();
        $data['grades'] = Grade::all();
        $data['classes'] = Classroom::all();
        $data['sections'] = Section::all();
        $data['parents'] = MyParent::all();
        return view('pages.Students.create',$data);
    }
    public function getClasses($id){
        $list_classes = Classroom::where('Grade_id',$id)->pluck('name','id');
        return $list_classes;
    }
    public function getSections($id){
        $list_sections = Section::where('Class_id',$id)->pluck('name','id');
        return $list_sections;
    }
    public function StoreStudent($request){
        DB::beginTransaction();
        try{
            $students = new Student();
            $students->name = ['en' => $request->name_en , 'ar' => $request->name];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->birth_date = $request->birth_date;
            $students->gender_id = $request->gender_id;
            $students->nationality_id = $request->nationality_id;
            $students->blood_id = $request->blood_id;
            $students->religion_id = $request->religion_id;
            $students->grade_id = $request->grade_id;
            $students->class_id = $request->class_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            if($request->hasFile('photos')){
                foreach($request->photos as $file){
                    $file_name = $file->getClientOriginalName();
                    $file->storeAs('attachment/students/'.$students->name,$file_name,'upload_attachment');
                    $image = new Image();
                    $image->file_name = $file_name;
                    $image->imageable_id = $students->id;
                    $image->imageable_type = 'App\Models\Student';
                    $image->save();
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
    public function ListStudent()
    {
        $students = Student::all();
        return view('pages.Students.index',compact('students'));
    }
    public function EditStudent($id)
    {
        $data['student'] = Student::findOrFail($id);
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();
        $data['religions'] = Religion::all();
        $data['grades'] = Grade::all();
        $data['classes'] = Classroom::all();
        $data['sections'] = Section::all();
        $data['parents'] = MyParent::all(); 
        return view('pages.Students.edit',$data);
    }
    public function UpdateStudent($request){
        try{
            $students = Student::findOrFail($request->id);
            $students->name = ['en' => $request->name_en , 'ar' => $request->name];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->birth_date = $request->birth_date;
            $students->gender_id = $request->gender_id;
            $students->nationality_id = $request->nationality_id;
            $students->blood_id = $request->blood_id;
            $students->religion_id = $request->religion_id;
            $students->grade_id = $request->grade_id;
            $students->class_id = $request->class_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            
            toastr()->success(trans('message.Edit'));
            return redirect()->route('Students.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        
    }
    public function DeleteStudent($request){
        
        Student::destroy($request->id);
        toastr()->error(trans('message.Delete'));
        return redirect()->route('Students.index');
    }
    public function ShowStudent($id){
        
        $students = Student::findOrFail($id);
        return view('pages.Students.show',compact('students'));
    }
    public function Upload_attachment($request){
        foreach($request->file('photos') as $file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs('attachment/students/'.$request->student_name,$file_name,'upload_attachment');

            $images = new Image();
            $images->file_name = $file_name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('message.Added'));
        return redirect()->route('Students.show',$request->student_id);
    }
    public function Download_attachment($student_name,$file_name){
        return response()->download(public_path('attachment/students/'.$student_name.'/'.$file_name));
    }
    public function Delete_attachment($request){
        Storage::disk('upload_attachment')->delete('attachment/students/'.$request->student_name.'/'.$request->file_name);
        Image::where('id',$request->id)->where('file_name',$request->file_name)->delete();
        toastr()->success(trans('message.Delete'));
        return redirect()->route('Students.show',$request->student_id);
    }
}