<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
  use HasFactory;

  protected $guarded = [
    'id',
  ];

  protected $fillable = ['id_dokter', 'hari', 'jam_mulai', 'jam_selesai', 'status'];

  public function dokter()
  {
    return $this->belongsTo(Dokter::class, 'id_dokter', 'id');
  }
}
