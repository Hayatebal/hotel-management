<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('reservation_id')
                ->constrained('reservations')
                ->cascadeOnDelete();

            // Reservation Amount
            $table->decimal('final_amount', 10, 2)->default(0);

            // Payment Details
            $table->decimal('amount', 10, 2)->default(0);

            $table->decimal('balance', 10, 2)->default(0);

            $table->enum('payment_method', [
                'Cash',
                'GCash',
                'Credit Card',
                'Debit Card',
                'Bank Transfer',
                'PayPal'
            ]);

            $table->string('reference_number')->nullable();

            $table->enum('status', [
                'pending',
                'paid'
            ])->default('pending');

            $table->timestamp('payment_date')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};