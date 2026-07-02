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
    Schema::create('families', function (Blueprint $table) {
        $table->id();
        // Yeh family member ko users table se connect karega (Login ke liye)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
        
        // Yeh check karega ke ye family member kis resident ka rishtedar hai
        $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade'); 
        
        $table->string('relation'); // Jaise: Son, Daughter, Brother, Spouse
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
