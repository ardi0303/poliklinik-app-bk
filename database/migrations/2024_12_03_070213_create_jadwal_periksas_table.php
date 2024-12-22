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
    Schema::create('jadwal_periksas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_dokter');
      $table->foreign('id_dokter')->references('id')->on('dokters')->constraint();
      $table->string('hari', 10);
      $table->time('jam_mulai');
      $table->time('jam_selesai');
      $table->string('status', 20);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('jadwal_periksas');
  }
};
