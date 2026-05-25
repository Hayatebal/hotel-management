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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('guest_name');
        $table->foreignId('room_id')->constrained()->cascadeOnDelete();
        $table->date('check_in');
        $table->date('check_out');
        $table->enum('status',['Reserved','Checked-in','Checked-out'])->default('Reserved');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
