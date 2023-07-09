<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory,HasTranslations;
    protected $table = 'teachers';
    protected $fillable = ['email','password','name','specialization_id','gender_id','joining_date','address'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function specialization(){
        return $this->belongsTo(Specialization::class);
    }
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function Section(){
        return $this->belongsToMany(Section::class,'teacher_sections');
    }
}
