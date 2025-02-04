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
        Schema::create('tblproducts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_product');
            $table->binary('image') -> nullable();
            $table->string('description');
            $table->integer('jumlah_product');
            $table->decimal('price',10,2);
            $table->boolean('product_unggulan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblproducts');
    }
};