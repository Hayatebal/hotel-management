<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();

        $table->foreignId('guest_id')->constrained('guests')->cascadeOnDelete();
        $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();

        $table->dateTime('check_in');
        $table->dateTime('check_out')->nullable();

        $table->integer('duration_hours');
        $table->decimal('price_per_hour', 10, 2);

        $table->decimal('extended_hours', 5, 2)->default(0);

        $table->decimal('extended_amount', 10, 2)->default(0);
        $table->decimal('final_amount', 10, 2);

        $table->enum('status', [
            'pending',
            'reserved',
            'checked_in',
            'checked_out',
            'cancelled'
        ])->default('pending');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};