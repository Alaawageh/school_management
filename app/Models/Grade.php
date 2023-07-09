<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model 
{
    use HasTranslations;
    protected $table = 'Grades';
    protected $fillable = ['name' , 'notes'];
    public $translatable = ['name'];
    public $timestamps = true;

    public function Section(){
        return $this->hasMany(Section::class);
    }
}