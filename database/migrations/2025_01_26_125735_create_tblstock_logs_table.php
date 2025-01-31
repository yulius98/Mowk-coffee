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
        Schema::create('tblstock_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nama_product_id')->constrained('tblproducts');
            $table->foreignId('jumlah_product_beli_id')->constrained('tblpembelians');
            $table->foreignId('jumlah_product_jual_id')->constrained('tblpenjualans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblstock_logs');
    }
};