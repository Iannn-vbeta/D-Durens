<?php

// Migration: create_artikel_wisata_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelWisataTable extends Migration
{
    public function up()
    {
        Schema::create('artikel_wisata', function (Blueprint $table) {
            $table->id('article_id');
            $table->string('title', 4000);
            $table->string('description', 4000);
            $table->date('created_at');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikel_wisata');
    }
}

// Migration: create_e_ticketing_table.php
class CreateETicketingTable extends Migration
{
    public function up()
    {
        Schema::create('e_ticketing', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->string('ticket_name', 4000);
            $table->integer('price');
            $table->string('deskripsi', 4000);
        });
    }

    public function down()
    {
        Schema::dropIfExists('e_ticketing');
    }
}

// Migration: create_pemesanan_tiket_table.php
class CreatePemesananTiketTable extends Migration
{
    public function up()
    {
        Schema::create('pemesanan_tiket', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->integer('total_ticket');
            $table->string('status', 4000);
            $table->date('transaction_date');
            $table->string('transaction_status', 4000);
            $table->date('ordering_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ticket_id')->references('ticket_id')->on('e_ticketing');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan_tiket');
    }
}

// Migration: create_kategori_barang_table.php
class CreateKategoriBarangTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_barang', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name', 4000);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_barang');
    }
}

// Migration: create_ketersediaan_table.php
class CreateKetersediaanTable extends Migration
{
    public function up()
    {
        Schema::create('ketersediaan', function (Blueprint $table) {
            $table->id('ketersediaan_id');
            $table->string('status', 4000);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ketersediaan');
    }
}

// Migration: create_kelayakan_table.php
class CreateKelayakanTable extends Migration
{
    public function up()
    {
        Schema::create('kelayakan', function (Blueprint $table) {
            $table->string('kelayakan_id', 40)->primary();
            $table->string('status', 4000);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelayakan');
    }
}

// Migration: create_inventaris_table.php
class CreateInventarisTable extends Migration
{
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->string('item_name', 4000);
            $table->integer('amount');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('ketersediaan_id');
            $table->string('kelayakan_id', 40);
            $table->string('deskripsi', 4000);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('category_id')->on('kategori_barang');
            $table->foreign('ketersediaan_id')->references('ketersediaan_id')->on('ketersediaan');
            $table->foreign('kelayakan_id')->references('kelayakan_id')->on('kelayakan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}