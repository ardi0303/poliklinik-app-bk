<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class DetailPeriksaController extends Controller
{
  public function getRiwayatPeriksa($id_pasien)
  {
    $id_dokter = Auth::guard('dokter')->id();
    $riwayatPeriksa = Periksa::whereHas('daftarPoli.jadwalPeriksa', function ($query) use ($id_dokter) {
      $query->where('id_dokter', $id_dokter);
    })->whereHas('daftarPoli', function ($query) use ($id_pasien) {
      $query->where('id_pasien', $id_pasien);
    })->with(['detailPeriksa.obat', 'daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter'])
      ->get();

    return response()->json($riwayatPeriksa);
  }

  public function getPasien()
  {
    $pasiens = Pasien::all();
    return view('dokter.riwayatPeriksa', compact('pasiens'));
  }
}
