<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table = 'sections';
    protected $fillable = ['name' , 'Grade_id','Class_id'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function Grade(){
        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function Classroom(){
        return $this->belongsTo(Classroom::class,'Class_id');
    }

    public function Teacher(){
        return $this->belongsToMany(Teacher::class,'teacher_sections');
    }
}
