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
        Schema::create('tblevents', function (Blueprint $table) {
            $table->id();
            $table->date('date_event');
            $table->time('time_event');
            $table->string('name_event')->unique();
            $table->enum('tiket',['free','paid']);
            $table->decimal('harga_tiket',10,2)->nullable();
            $table->string('description_event');
            $table->string('location_event');
            $table->string('image_event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblevents');
    }
};