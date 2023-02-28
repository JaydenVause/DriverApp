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
        Schema::create('days_times_driving_driving_instructors', function($table){
            $table->id();
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->time('monday_to')->nullable();
            $table->time('monday_from')->nullable();
            $table->time('tuesday_to')->nullable();
            $table->time('tuesday_from')->nullable();
            $table->time('wednesday_to')->nullable();
            $table->time('wednesday_from')->nullable();
            $table->time('thursday_to')->nullable();
            $table->time('thursday_from')->nullable();
            $table->time('friday_to')->nullable();
            $table->time('friday_from')->nullable();
            $table->time('saturday_to')->nullable();
            $table->time('saturday_from')->nullable();
            $table->time('sunday_to')->nullable();
            $table->time('sunday_from')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_times_driving_driving_instructors');
    }
};
