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
        Schema::create('batch_mentor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id');
            $table->foreignId('mentor_id');

            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('mentor_id')->references('id')->on('mentor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_mentor');
    }
};
