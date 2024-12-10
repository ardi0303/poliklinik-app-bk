<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
  public function getJadwalPeriksa()
  {
    $id_dokter = Auth::guard('dokter')->id();

    // Mengambil data JadwalPeriksa berdasarkan id_dokter
    $jadwalPeriksas = JadwalPeriksa::with('dokter')
      ->where('id_dokter', $id_dokter)
      ->get();

    return view('dokter.jadwalPeriksa', compact('jadwalPeriksas'));
  }
}
