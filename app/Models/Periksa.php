<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
  use HasFactory;

  protected $guarded = [
    'id',
  ];

  protected $fillable = ['id_daftar_poli', 'tgl_periksa', 'catatan', 'biaya_periksa'];

  public function daftarPoli()
  {
    return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli', 'id');
  }
  public function detailPeriksa()
  {
    return $this->hasMany(DetailPeriksa::class, 'id_periksa');
  }

  protected $appends = ['status_periksa'];

  public function getStatusPeriksaAttribute()
  {
    $isPeriksa = Periksa::where('id_daftar_poli', $this->id)->exists();
    return $isPeriksa ? 'Edit' : 'Periksa';
  }
}
