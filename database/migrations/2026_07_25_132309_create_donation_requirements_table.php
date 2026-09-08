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
        Schema::create('donation_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('category'); // Food, Clothes, Medicine, Money
            $table->string('quantity_needed');
            $table->string('urgency'); // High, Medium, Low
            $table->string('status'); // Critical, Needed, Partial
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_requirements');
    }
};
