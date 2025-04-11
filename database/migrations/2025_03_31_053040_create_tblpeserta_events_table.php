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
        Schema::create('tblpeserta_events', function (Blueprint $table) {
            $table->id();
            $table->string('name_event')->unique();
            $table->string('nama_peserta');
            $table->string('alamat_peserta');
            $table->string('no_HP');
            $table->string('email_peserta');
            $table->enum('status_pembanyaran',['free','pending','paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblpeserta_events');
    }
};