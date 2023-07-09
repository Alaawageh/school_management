<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function GetAllTeachers(){
        return Teacher::all();
        
    }
    public function Getspecializations(){
        return Specialization::all();
    }
    public function GetGender(){
        return Gender::all();
    }
    public function StoreTeacher($request){
        try{
            $Teachers = new Teacher();
            $Teachers->email = $request->email;
            $Teachers->password = Hash::make($request->password);
            $Teachers->name = ['ar' => $request->name , 'en' => $request->name_en];
            $Teachers->specialization_id = $request->specialization_id;
            $Teachers->gender_id = $request->gender_id;
            $Teachers->joining_date = $request->joining_date;
            $Teachers->address = $request->address;
            $Teachers->save();
            toastr()->success(trans('message.Added'));
            return redirect()->route('Teachers.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function Edit($id){
       return Teacher::find($id);
       
    }
    public function UpdateTeacher($request){
        try{
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->email = $request->email;
            $Teachers->password = Hash::make($request->password);
            $Teachers->name = ['ar' => $request->name , 'en' => $request->name_en];
            $Teachers->specialization_id = $request->specialization_id;
            $Teachers->gender_id = $request->gender_id;
            $Teachers->joining_date = $request->joining_date;
            $Teachers->address = $request->address;
            $Teachers->save();
            toastr()->success(trans('message.Edit'));
            return redirect()->route('Teachers.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function DeleteTeacher($request){
        Teacher::find($request->id)->delete();
        toastr()->success(trans('message.Delete'));
        return redirect()->route('Teachers.index');
    }
}
