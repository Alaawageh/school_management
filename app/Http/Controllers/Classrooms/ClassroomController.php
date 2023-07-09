<?php 


namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Classes = Classroom::all();
    $Grades = Grade::all();
    return view('pages.Classrooms.index',compact('Classes','Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreClassroomRequest $request)
  {
   
    
    try{
      $validated = $request->validated();
      $List_Classes = $request->List_Classes;
      foreach($List_Classes as $List_Class){
        $Classes = new Classroom();
        $Classes->name = ['en' => $List_Class['name_en'] , 'ar' => $List_Class['name']];
        $Classes->Grade_id = $List_Class['Grade_id'];
        $Classes->save();
      }
      toastr()->success(trans('message.Added'));
  
       return redirect()->route('Classes.index');
    }catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    $this->validate($request,[
      'name' => 'required',
      'name_en' => 'required'
    ],[
      'name.required' => trans('validation.required'),
      'name_en.required' => trans('validation.required'),
    ]);
    try{
      $Classes = Classroom::findOrFail($request->id);
      $Classes->update([
        'name' => ['en' => $request->name_en , 'ar' => $request->name],
        'Grade_id' => $request->Grade_id,
      ]);
      toastr()->success(trans('message.Edit'));

      return redirect()->route('Classes.index');
    }catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $Classes = Classroom::find($request->id)->delete();
    toastr()->success(trans('message.Delete'));

    return redirect()->route('Classes.index');
  }

  public function delete_all(Request $request){
    $delete_all_id = explode(',',$request->delete_all_id);
    Classroom::whereIn('id',$delete_all_id)->Delete();
    toastr()->success(trans('message.Delete'));

    return redirect()->route('Classes.index');
  }

  public function Filter_Classes(Request $request){
    // dd($request);
    $Grades = Grade::all();
    $Classes = Classroom::select('*')->where('Grade_id',$request->Grade_id)->get();
    return view('pages.Classrooms.index',compact('Grades','Classes'));
  }
  
}

?>