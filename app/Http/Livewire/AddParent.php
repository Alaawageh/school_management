<?php

namespace App\Http\Livewire;

use App\Models\MyParent;
use Livewire\Component;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\TypeBlood;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage = '';
    public $catchError, $parent_id;
    public $currentStep = 1 ,$show_mode = true , $update_mode = false, $photos,
    $Email,$Password,$father_name,$father_name_en,$father_job,
    $father_job_en,$father_national_id,$father_phone,$Nationality_father_id,
    $Blood_type_father_id,$Religion_father_id,$father_address,

    $mother_name,$mother_name_en,$mother_job,$mother_job_en,
    $mother_national_id,$mother_phone,$Nationality_mother_id,
    $Blood_type_mother_id,$Religion_mother_id,$mother_address
    ;
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'Email' => 'required|email',
            'father_national_id' => 'required|string|min:11|max:11',
            'father_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_national_id' => 'required|string|min:11|max:11',
            'mother_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10' 
        ]);
    }

    public function firstStepSubmit(){
        $this->validate([
            'Email' => 'required|unique:my_parents,Email,'.$this->id,
            'Password' => 'required',
            'father_name' => 'required',
            'father_name_en' => 'required',
            'father_national_id' => 'required|unique:my_parents,father_national_id,' . $this->id,
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_father_id' => 'required',
            'Blood_type_father_id' => 'required',
            'Religion_father_id' => 'required',
        ]);

        $this->currentStep = 2;
    }
    public function secondeStepSubmit(){
        $this->validate([
            'mother_name' => 'required',
            'mother_name_en' => 'required',
            'mother_national_id' => 'required|unique:my_parents,mother_national_id,' . $this->id,
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_mother_id' => 'required',
            'Blood_type_mother_id' => 'required',
            'Religion_mother_id' => 'required',
        ]);
        $this->currentStep = 3;
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods' => TypeBlood::all(),
            'Religions' => Religion::all(),
            'my_parents' => MyParent::all(),
        ]);
    }
   public function submitForm(){
    try{
        $parents = new MyParent();
        $parents->Email = $this->Email;
        $parents->Password = $this->Password;
        $parents->father_name = ['ar' => $this->father_name ,'en' => $this->father_name_en];
        $parents->father_job = ['ar' => $this->father_job ,'en' => $this->father_job_en];
        $parents->father_national_id = $this->father_national_id;
        $parents->father_phone = $this->father_phone;
        $parents->Nationality_father_id = $this->Nationality_father_id;
        $parents->Blood_type_father_id = $this->Blood_type_father_id;
        $parents->Religion_father_id = $this->Religion_father_id;
        $parents->father_address = $this->father_address;
        $parents->mother_name = ['ar' => $this->mother_name ,'en' => $this->mother_name_en];
        $parents->mother_job = ['ar' => $this->mother_name ,'en' => $this->mother_job_en];
        $parents->mother_national_id = $this->mother_national_id;
        $parents->mother_phone = $this->mother_phone;
        $parents->Nationality_mother_id = $this->Nationality_mother_id;
        $parents->Blood_type_mother_id = $this->Blood_type_mother_id;
        $parents->Religion_mother_id = $this->Religion_mother_id;
        $parents->mother_address = $this->mother_address;
        $parents->save();
        if(!empty($this->photos)){
            foreach($this->photos as $photo){
                $photo->storeAs($this->father_national_id,$photo->getClientOriginalName(), $disk = 'parent_attachment');
            }
            ParentAttachment::create([
                'file_name' => $photo->getClientOriginalName(),
                'parent_id' => MyParent::latest()->first()->id,
            ]);
        }
        $this->successMessage = trans('message.Added');
        $this->clearForm();
        $this->currentStep = 1;
    }catch(\Exception $e){
        $this->catchError = $e->getMessage();
    }
   }

   public function edit($id){
    $this->show_mode = false;
    $this->update_mode = true;
    $my_parent = MyParent::where('id',$id)->first();
    $this->parent_id = $id;
    $this->Email = $my_parent->Email;
    $this->Password = $my_parent->Password;
    $this->father_name = $my_parent->getTranslation('father_name','ar');
    $this->father_name_en = $my_parent->getTranslation('father_name','en');
    $this->father_job = $my_parent->getTranslation('father_job','ar');
    $this->father_job_en = $my_parent->getTranslation('father_job','en');
    $this->father_national_id = $my_parent->father_national_id;
    $this->father_phone = $my_parent->father_phone;
    $this->Nationality_father_id = $my_parent->Nationality_father_id;
    $this->Blood_type_father_id = $my_parent->Blood_type_father_id;
    $this->Religion_father_id = $my_parent->Religion_father_id;
    $this->father_address = $my_parent->father_address;
    $this->mother_name = $my_parent->getTranslation('mother_name','ar');
    $this->mother_name_en = $my_parent->getTranslation('mother_name','en');
    $this->mother_job = $my_parent->getTranslation('mother_job','ar');
    $this->mother_job_en = $my_parent->getTranslation('mother_job','ar');
    $this->mother_national_id = $my_parent->mother_national_id;
    $this->mother_phone = $my_parent->mother_phone;
    $this->Nationality_mother_id = $my_parent->Nationality_mother_id;
    $this->Blood_type_mother_id = $my_parent->Blood_type_mother_id;
    $this->Religion_mother_id = $my_parent->Religion_mother_id;
    $this->mother_address = $my_parent->mother_address;
   }

   public function delete($id){
    MyParent::find($id)->delete();
    return redirect()->to('/add_parent');
   }

   public function clearForm(){
    $this->Email = '';
    $this->Password = '';
    $this->father_name = '';
    $this->father_job = '';
    $this->father_national_id = '';
    $this->father_phone = '';
    $this->Nationality_father_id = '';
    $this->Blood_type_father_id = '';
    $this->Religion_father_id = '';
    $this->father_address = '';
    $this->mother_name = '';
    $this->mother_job = '';
    $this->mother_national_id = '';
    $this->mother_phone = '';
    $this->Nationality_mother_id = '';
    $this->Blood_type_mother_id = '';
    $this->Religion_mother_id = '';
    $this->mother_address = '';
   } 
   public function showFormAdd(){
    $this->show_mode = false;
   }
   public function firstStepSubmit_edit(){
    $this->update_mode = true;
    $this->currentStep = 2;
   }
   public function secondeStepSubmit_edit(){
    $this->update_mode = true;
    $this->currentStep = 3;
   }
   public function submitForm_edit(){
    if($this->parent_id){
        $parents = MyParent::find($this->parent_id);
        $parents->update([
            'Email' => $this->Email,
            'Password' => $this->Password,
            'father_name' => ['ar' => $this->father_name ,'en' => $this->father_name_en],
            'father_job' => ['ar' => $this->father_job ,'en' => $this->father_job_en],
            'father_national_id' => $this->father_national_id,
            'father_phone' => $this->father_phone,
            'Nationality_father_id' => $this->Nationality_father_id,
            'Blood_type_father_id' => $this->Blood_type_father_id,
            'Religion_father_id' => $this->Religion_father_id,
            'father_address' => $this->father_address,
            'mother_name' => ['ar' => $this->mother_name ,'en' => $this->mother_name_en],
            'mother_job' => ['ar' => $this->mother_name ,'en' => $this->mother_job_en],
            'mother_national_id' => $this->mother_national_id,
            'mother_phone' => $this->mother_phone,
            'Nationality_mother_id' => $this->Nationality_mother_id,
            'Blood_type_mother_id' => $this->Blood_type_mother_id,
            'Religion_mother_id' => $this->Religion_mother_id,
            'mother_address' => $this->mother_address,
        ]);
        return redirect()->to('/add_parent');
    }
   }
   
}
