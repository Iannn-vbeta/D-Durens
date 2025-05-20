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
            $table->id('transaction_id');
            $table->integer('total_ticket');
            $table->date('transaction_date');
            $table->date('ordering_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('status_pemesanan_id');
        
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