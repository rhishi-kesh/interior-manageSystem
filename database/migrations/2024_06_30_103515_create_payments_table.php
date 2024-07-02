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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->string('paymentType','5')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('total')->nullable();
            $table->string('paymentNumber')->nullable();
            $table->string('admissionFee','5')->nullable()->default('0')->comment('0 = No, 1 = Yes');
            $table->string('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
