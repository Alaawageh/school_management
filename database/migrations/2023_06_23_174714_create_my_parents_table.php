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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('father_name');
            $table->string('father_job')->nullable();
            $table->string('father_national_id');
            $table->string('father_phone');
            $table->string('father_address');
            $table->foreignId('Nationality_father_id')->references('id')->on('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('Blood_type_father_id')->references('id')->on('type_bloods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('Religion_father_id')->references('id')->on('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('mother_name');
            $table->string('mother_job')->nullable();
            $table->string('mother_national_id');
            $table->string('mother_phone');
            $table->string('mother_address');
            $table->foreignId('Nationality_mother_id')->references('id')->on('nationalities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('Blood_type_mother_id')->references('id')->on('type_bloods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('Religion_mother_id')->references('id')->on('religions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
