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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('cnic')->unique();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('shift');
            $table->date('date_of_joining');
            $table->decimal('salary', 10, 2);
            $table->text('address')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('status')->default('Active'); // Shuru mein sab active honge
            $table->timestamps(); // Yeh created_at aur updated_at khud bana deta hai
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
