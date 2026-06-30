<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            // 1. Personal Information
            $table->string('name');
            $table->integer('age');
            $table->string('gender');
            $table->string('room_number');
            $table->date('date_of_admission');

            // 2. Medical Information
            $table->string('medical_condition'); // Stable, Critical, Recovering
            $table->integer('bp_systolic');
            $table->integer('bp_diastolic');
            $table->decimal('sugar_level', 4, 1); // e.g., 6.2 ya 11.5

            // 3. Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
