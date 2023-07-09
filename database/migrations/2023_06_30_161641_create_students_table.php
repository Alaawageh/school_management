<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date');
            $table->foreignId('gender_id')->references('id')->on('genders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('nationality_id')->references('id')->on('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('blood_id')->references('id')->on('type_bloods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('religion_id')->references('id')->on('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('class_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parent_id')->references('id')->on('my_parents')->onDelete('cascade')->onUpdate('cascade');
            $table->string('academic_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
