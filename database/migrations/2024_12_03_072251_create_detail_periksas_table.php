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
    Schema::create('detail_periksas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_periksa');
      $table->foreign('id_periksa')->references('id')->on('periksas')->constraint();
      $table->unsignedBigInteger('id_obat');
      $table->foreign('id_obat')->references('id')->on('obats')->constraint();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('detail_periksas');
  }
};
