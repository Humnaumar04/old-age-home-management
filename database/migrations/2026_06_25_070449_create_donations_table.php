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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Donor ID
            $table->string('donation_type'); // Money, Food, Clothes, Medicine
            $table->decimal('amount', 10, 2)->nullable(); // Money amount
            $table->string('payment_method')->nullable(); // HBL Account, JazzCash, Easypaisa
            $table->string('transaction_id')->nullable(); // Transaction reference ID
            $table->string('item_name')->nullable(); // For food, clothes, medicine
            $table->string('quantity')->nullable(); // Quantity or weight
            $table->string('delivery_method')->nullable(); // Drop-off or Pickup
            $table->text('message')->nullable(); // Message for residents
            $table->string('visibility')->default('Public'); // Public or Anonymous
            $table->string('status')->default('Pending'); // Pending, Approved, Verified
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
