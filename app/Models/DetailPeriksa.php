<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
  use HasFactory;

  protected $guarded = [
    'id',
  ];

  protected $fillable = ['id_obat', 'id_periksa'];

  public function periksa()
  {
    return $this->belongsTo(Periksa::class, 'id_periksa');
  }

  public function obat()
  {
    return $this->belongsTo(Obat::class, 'id_obat');
  }
}
