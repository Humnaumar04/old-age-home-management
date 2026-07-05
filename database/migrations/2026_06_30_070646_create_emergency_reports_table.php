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
        Schema::create('emergency_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id'); // Resident link karne ke liye
            $table->unsignedBigInteger('staff_id');    // Report karne wala staff
            $table->string('emergency_type');
            $table->string('severity_level');
            $table->dateTime('incident_time');
            $table->text('description');
            $table->text('action_taken')->nullable();
            $table->text('other_staff_present')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_reports');
    }
};
