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
    Schema::create('periksas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_daftar_poli');
      $table->foreign('id_daftar_poli')->references('id')->on('daftar_polis')->constraint();
      $table->date('tgl_periksa');
      $table->text('catatan');
      $table->integer('biaya_periksa');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('periksas');
  }
};
