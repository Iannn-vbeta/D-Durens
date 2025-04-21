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
        Schema::create('e_ticketing', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->string('ticket_name');
            $table->integer('price');
            $table->text('deskripsi');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_ticketing');
    }
};