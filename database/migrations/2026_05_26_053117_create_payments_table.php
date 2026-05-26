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

            $table->decimal('amount', 10, 2);

            $table->enum('payment_method', [
                'Cash',
                'GCash',
                'Credit Card',
                'Debit Card',
                'Bank Transfer',
                'PayPal'
            ]);

            $table->dateTime('payment_date');

            $table->enum('status', [
                'pending',
                'paid'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};