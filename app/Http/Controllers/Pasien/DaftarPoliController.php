<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DaftarPoliController extends Controller
{
  public function getDaftarPoli()
  {
    $id_pasien = Auth::guard('pasien')->id();
    $no_rm = Auth::guard('pasien')->user()->no_rm;
    $polis = Poli::all();

    $daftarPolis = DaftarPoli::with('pasien', 'jadwalPeriksa')
      ->where('id_pasien', $id_pasien)
      ->get();

    return view('pasien.daftarPoli', compact('daftarPolis', 'polis', 'no_rm'));
  }
  public function getJadwalByPoli($id_poli)
  {
    $jadwalPeriksas = JadwalPeriksa::with('dokter')
      ->where('status', 'Aktif')
      ->whereHas('dokter', function ($query) use ($id_poli) {
        $query->where('id_poli', $id_poli);
      })->get();

    return response()->json($jadwalPeriksas);
  }
  public function addDaftarPoli(Request $request)
  {
    $request->validate([
      'id_jadwal' => 'required',
      'keluhan' => 'required',
    ]);

    $id_pasien = Auth::guard('pasien')->id();
    $no_antrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count() + 1;

    try {
      DaftarPoli::create([
        'id_pasien' => $id_pasien,
        'id_jadwal' => $request->id_jadwal,
        'keluhan' => $request->keluhan,
        'no_antrian' => $no_antrian,
      ]);
      return redirect()->route('pasien.daftar-poli')->with('success', 'Pendaftaran poli berhasil.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }
}
