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
        Schema::create('tbltransaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembeli');
            $table->string('nama_product');
            $table->integer('jumlah_product');
            $table->decimal('total_price',10,2);
            $table->string('alamat_pengiriman')->nullable();
            $table->string('no_HP')->nullable();
            $table->enum('status_transaksi', ['pending', 'paid', 'send', 'success', 'failed', 'expired']);
            $table->string('AWB_Bill')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbltransaksis');
    }
};