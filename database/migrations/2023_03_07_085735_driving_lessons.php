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
        Schema::create('driving_lessons', function($table){
            $table->id();
            $table->foreignId('instructor_id')->nullOnDelete();
            $table->foreignId('user_id')->nullOnDelete();
            $table->dateTime('lesson_datetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driving_lessons');
    }
};
