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
            $table->string('student_id', '20');
            $table->foreignId('is_fromSite')->nullable()->default('0');
            $table->foreignId('batch_id')->nullable()->default('0');
            $table->foreignId('department_id');
            $table->string('name');
            $table->string('fName');
            $table->string('mName');
            $table->string('dateofbirth');
            $table->string('profile')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('address');
            $table->string('mobile');
            $table->string('qualification')->nullable();
            $table->string('profession')->nullable();
            $table->string('guardianMobileNo')->nullable();
            $table->string('class_days')->nullable();
            $table->string('is_certificate')->default('no');
            $table->string('student_status')->default('running');
            $table->timestamps();
            $table->softDeletes();
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
