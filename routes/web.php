<?php

use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Teachers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('/',function(){
    return view('auth.login');
});


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
    Route::resource('Grades',GradeController::class);
    Route::resource('Classes',ClassroomController::class);
    Route::get('classes/{id}',[SectionController::class,'getClasses'])->name('getClasses');
    Route::post('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all');
    Route::post('Filter_Classes',[ClassroomController::class,'Filter_Classes'])->name('Filter_Classes');
    Route::resource('Sections',SectionController::class);
    Route::view('add_parent','livewire.show_Form');
    Route::resource('Teachers',TeacherController::class);
    Route::resource('Students',StudentController::class);
    Route::get('my_classes/{id}',[StudentController::class,'getClasses'])->name('getClasses');
    Route::get('my_sections/{id}',[StudentController::class,'getSections'])->name('getSections');
    Route::post('Upload_attachment',[StudentController::class,'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{student_name}/{file_name}',[StudentController::class,'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment',[StudentController::class,'Delete_attachment'])->name('Delete_attachment');
    Route::resource('Promotions',PromotionController::class);
});




