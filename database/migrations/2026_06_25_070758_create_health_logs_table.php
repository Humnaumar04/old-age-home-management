<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('health_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');
            $table->integer('bp_systolic');
            $table->integer('bp_diastolic');
            $table->decimal('sugar_level', 4, 1);
            $table->decimal('body_temperature', 4, 1);
            $table->integer('pulse_rate');
            $table->integer('oxygen_saturation');
            $table->foreignId('logged_by_staff_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_logs');
    }
};