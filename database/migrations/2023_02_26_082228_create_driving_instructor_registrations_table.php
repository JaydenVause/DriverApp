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
        Schema::create('driving_instructor_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('date_of_birth');
            $table->string('drivers_license_number');
            $table->integer('country_id');
            $table->string('wwcc');
            $table->string('medical');
            $table->boolean('tandc');
            $table->timestamps();

            // 'user_id' => $user->id,
            // 'date_of_birth' => $date_of_birth,
            // 'drivers_license_number' => $drivers_license_number,
            // 'country' => $country,
            // 'wwcc' => $wwcc,
            // 'medical' => $medical_file->hashName(),
            // 'tandc' => $tandc
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driving_instructor_registrations');
    }
};
