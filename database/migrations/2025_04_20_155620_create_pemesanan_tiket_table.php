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
        Schema::create('pemesanan_tiket', function (Blueprint $table) {
            $table->id('transaction_id'); // AUTO_INCREMENT dan PRIMARY KEY
            $table->integer('total_ticket')->nullable(false);
            $table->date('transaction_date')->nullable(); // Sesuai gambar: NULL allowed
            $table->date('ordering_date')->nullable(false);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('status_pemesanan_id');

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ticket_id')->references('ticket_id')->on('e_ticketing')->onDelete('cascade');
            $table->foreign('status_pemesanan_id')->references('status_id')->on('status_pemesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_tiket');
    }
};
