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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->string('item_name');
            $table->integer('amount');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('ketersediaan_id');
            $table->string('kelayakan_id', 40);
            $table->text('deskripsi');
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('kategori_barang')->onDelete('cascade');
            $table->foreign('ketersediaan_id')->references('ketersediaan_id')->on('ketersediaan')->onDelete('cascade');
            $table->foreign('kelayakan_id')->references('kelayakan_id')->on('kelayakan')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};