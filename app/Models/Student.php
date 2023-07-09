<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory,HasTranslations;
    protected $table = 'students';
    protected $guarded = [];
    public $translatable = ['name'];
    public $timestamps = true;

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function parent(){
        return $this->belongsTo(MyParent::class,'parent_id');
    }
    public function nationality(){
        return $this->belongsTo(Nationalitie::class,'nationality_id');
    }
    public function blood(){
        return $this->belongsTo(TypeBlood::class,'blood_id');
    }
    public function religion(){
        return $this->belongsTo(Religion::class,'religion_id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
