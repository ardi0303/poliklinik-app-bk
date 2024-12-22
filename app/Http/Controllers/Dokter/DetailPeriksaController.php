<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class DetailPeriksaController extends Controller
{
  public function getRiwayatPeriksa()
  {
    $id_dokter = Auth::guard('dokter')->id();

    $periksas = Periksa::with([
      'detailPeriksa.obat',
      'daftarPoli.pasien'
    ])
      ->whereHas('daftarPoli.jadwalPeriksa', function ($query) use ($id_dokter) {
        $query->where('id_dokter', $id_dokter);
      })
      ->get();

    return view('dokter.riwayatPeriksa', compact('periksas'));
  }
}
