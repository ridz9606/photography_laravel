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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('slot_id')->constrained('slots', 'id');
            $table->foreignId('client_id')->constrained('clients', 'id');
            $table->date('appointment_date');
            $table->enum('status', ['selected', 'booked', 'cancelled'])->default('selected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
