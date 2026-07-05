<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daily_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');
            $table->string('breakfast')->nullable();       // Done, Skipped, Partial
            $table->string('morning_walk')->nullable();     // Done, Skipped, Partial
            $table->string('lunch')->nullable();            // Done, Skipped, Partial
            $table->string('medication_taken')->nullable(); // Done, Skipped, Partial
            $table->string('physical_therapy')->nullable(); // Done, Skipped, Partial
            $table->string('dinner')->nullable();           // Done, Skipped, Partial
            $table->string('sleep_routine')->nullable();    // Done, Skipped, Partial
            $table->text('staff_notes')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_activities');
    }
};