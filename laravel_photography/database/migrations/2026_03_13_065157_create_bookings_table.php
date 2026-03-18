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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('appointment_id')->constrained('appointments', 'id');
            $table->foreignId('category_id')->constrained('categories', 'id');
            $table->foreignId('package_id')->constrained('packages', 'id');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('advance_amount', 10, 2)->default(0.00);
            $table->decimal('remaining_amount', 10, 2)->default(0.00);
            $table->enum('booking_status', ['pending', 'confirm', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['partial', 'paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
