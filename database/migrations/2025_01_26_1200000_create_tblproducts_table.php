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
            $table->string('nama_product') -> unique();
            $table->string('category');
            $table->string('image') -> nullable();
            $table->string('description')->nullable();
            $table->enum('discount', ['yes', 'no'])->default('no');
            $table->decimal('discount_price',50,2)->nullable();
            $table->decimal('price',50,2);
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