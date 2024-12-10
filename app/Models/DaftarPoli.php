<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
  use HasFactory;

  protected $guarded = [
    'id',
  ];

  protected $fillable = ['id_pasien', 'id_jadwal', 'keluhan', 'no_antrian'];

  public function pasien()
  {
    return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
  }
  public function jadwalPeriksa()
  {
    return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal', 'id');
  }
  public function periksa()
  {
    return $this->hasOne(Periksa::class, 'id_daftar_poli');
  }

  protected $appends = ['status_periksa', 'dokter_action'];

  public function getStatusPeriksaAttribute()
  {
    $isPeriksa = Periksa::where('id_daftar_poli', $this->id)->exists();
    return $isPeriksa ? 'Sudah Diperiksa' : 'Belum Diperiksa';
  }

  public function getDokterActionAttribute()
  {
    $isPeriksa = Periksa::where('id_daftar_poli', $this->id)->exists();
    return $isPeriksa ? 'Edit' : 'Periksa';
  }
}
