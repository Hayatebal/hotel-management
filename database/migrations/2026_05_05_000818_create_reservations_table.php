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
        Schema::create('reservations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('guest_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('room_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();

            $table->integer('duration_hours')->default(0);

            $table->decimal('price_per_hour', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);

            $table->integer('extended_hours')->default(0);
            $table->decimal('extended_amount', 10, 2)->default(0);

            $table->decimal('final_amount', 10, 2)->default(0);

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