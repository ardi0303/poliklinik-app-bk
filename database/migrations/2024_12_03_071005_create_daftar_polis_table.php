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
    Schema::create('daftar_polis', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_pasien');
      $table->foreign('id_pasien')->references('id')->on('pasiens')->constraint();
      $table->unsignedBigInteger('id_jadwal');
      $table->foreign('id_jadwal')->references('id')->on('jadwal_periksas')->constraint();
      $table->text('keluhan');
      $table->integer('no_antrian')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('daftar_polis');
  }
};
