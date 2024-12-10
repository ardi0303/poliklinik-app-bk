<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dokter extends Authenticatable
{
  use HasFactory;

  protected $guarded = [
    'id',
  ];

  protected $fillable = ['nama', 'alamat', 'no_hp', 'id_poli'];

  public function poli()
  {
    return $this->belongsTo(Poli::class, 'id_poli', 'id');
  }
}
