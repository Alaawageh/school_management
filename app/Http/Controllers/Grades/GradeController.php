<?php 


namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGradesRequest;
use App\Models\Classroom;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.Grades.index',compact('Grades'));
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
  public function store(StoreGradesRequest $request)
  {
    // if(Grade::where('name->ar',$request->name)->orWhere('name->en',$request->name_en)->exists()){
    //   return redirect()->back()->withErrors(trans('Grades.exists'));
    // }
    $validated = $request->validated();

    try {
      $Grades = new Grade();
      $translations = [
        'en' => $request->name_en,
        'ar' => $request->name,
     ];
     
     $Grades->setTranslations('name', $translations);
     $Grades->notes = $request->notes;
     $Grades->save();
     toastr()->success(trans('message.Added'));

     return redirect()->route('Grades.index');

    } catch (\Exception $e) {
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
  public function update(StoreGradesRequest $request)
  {
    $validated = $request->validated();
    try{
      $Grades = Grade::findOrFail($request->id);
      $Grades->update([
        'name' => ['en' => $request->name_en , 'ar' => $request->name],
        'notes' => $request->notes
      ]);
      toastr()->success(trans('message.Edit'));

      return redirect()->route('Grades.index');
    } catch (\Exception $e) {
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
    
    try{
      $Classes = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
      if($Classes->count() == 0){
        $Grades = Grade::find($request->id)->delete();
        toastr()->success(trans('message.Delete'));
    
      return redirect()->route('Grades.index');
      }else{
        toastr()->error(trans('message.Error_Delete'));
    
      return redirect()->route('Grades.index');
      }
    }catch(\Exception $e){
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    
  }
  
}

?>