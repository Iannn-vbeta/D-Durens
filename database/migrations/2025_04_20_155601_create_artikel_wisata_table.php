<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('artikel_wisata', function (Blueprint $table) {
            $table->id('article_id');
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('artikel_wisata');
    }
};