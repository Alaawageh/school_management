<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model 
{
    use HasTranslations;
    protected $table = 'Classrooms';
    protected $fillable = ['name' , 'Grade_id'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function Grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function Section(){
        return $this->hasMany(Section::class);
    }

}