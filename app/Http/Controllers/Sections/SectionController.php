<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Section;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Teacher;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        $List_Grades = Grade::with(['Section'])->get();
        $teachers = Teacher::all();
        return view('pages.Sections.index',compact('Grades','List_Grades','teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        $validated = $request->validated();
       try{
        $sections = new Section();
        $sections->name = ['en' => $request->name_en , 'ar' => $request->name];
        $sections->Grade_id = $request->Grade_id;
        $sections->Class_id = $request->Class_id;
        $sections->save();
        $sections->Teacher()->attach($request->teacher_id);
        toastr()->success(trans('message.Added'));

        return redirect()->route('Sections.index');
       }catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSectionRequest $request)
    {
        $validated = $request->validated();
        try{
            $sections = Section::findOrFail($request->id);
            $sections->update([
                'name' => ['en' => $request->name_en , 'ar' => $request->name],
                'Grade_id' => $request->Grade_id,
                'Class_id' => $request->Class_id,
            ]);
            //update pivot table 
            if(isset($request->teacher_id)){
                $sections->Teacher()->sync($request->teteacher_id);
            }else{
                $sections->Teacher()->sync(array());
            }
            toastr()->success(trans('message.Edit'));

            return redirect()->route('Sections.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $sections = Section::find($request->id)->delete();
        toastr()->success(trans('message.Delete'));
    
      return redirect()->route('Sections.index');
    }

    public function getClasses($id){
        $classes = Classroom::where('Grade_id',$id)->pluck('name','id');
        return $classes;
    }
}
