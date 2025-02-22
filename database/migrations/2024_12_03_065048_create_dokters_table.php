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
    Schema::create('dokters', function (Blueprint $table) {
      $table->id();
      $table->string('nama');
      $table->string('alamat');
      $table->integer('no_hp');
      $table->unsignedBigInteger('id_poli');
      $table->foreign('id_poli')->references('id')->on('polis')->constraint();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('dokters');
  }
};
