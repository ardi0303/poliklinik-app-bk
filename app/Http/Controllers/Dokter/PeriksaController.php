<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
  public function getDaftarPoli()
  {
    $id_dokter = Auth::guard('dokter')->id();
    $obats = Obat::all();

    $daftarPolis = DaftarPoli::with([
      'pasien',
      'jadwalPeriksa',
      'periksa.detailPeriksa.obat'
    ])
      ->whereHas('jadwalPeriksa', function ($query) use ($id_dokter) {
        $query->where('id_dokter', $id_dokter);
      })
      ->get();

    return view('dokter.periksa', compact('daftarPolis', 'obats'));
  }

  public function addPeriksa(Request $request)
  {
    $request->validate([
      'nama' => 'required|string',
      'tgl_periksa' => 'required|date',
      'catatan' => 'nullable|string',
      'obat' => 'required|array',
      'obat.*' => 'exists:obats,id',
      'biaya_periksa' => 'required|numeric',
    ]);

    $periksa = new Periksa();
    $periksa->id_daftar_poli = $request->id_daftar_poli;
    $periksa->tgl_periksa = $request->tgl_periksa;
    $periksa->catatan = $request->catatan;
    $periksa->biaya_periksa = $request->biaya_periksa;
    $periksa->save();

    foreach ($request->obat as $obatId) {
      DetailPeriksa::create([
        'id_periksa' => $periksa->id,
        'id_obat' => $obatId,
      ]);
    }

    return redirect()->route('dokter.periksa')->with('success', 'Periksa has been successfully added.');
  }

  public function updatePeriksa(Request $request, $id)
  {
    // Validate incoming data
    $request->validate([
      'tgl_periksa' => 'required|date',
      'catatan' => 'nullable|string',
      'obat' => 'required|array',
      'obat.*' => 'exists:obats,id',
      'biaya_periksa' => 'required|numeric',
    ]);

    // Find the existing Periksa record
    $periksa = Periksa::where('id_daftar_poli', $id)->firstOrFail();

    // Update the Periksa record
    $periksa->tgl_periksa = $request->tgl_periksa;
    $periksa->catatan = $request->catatan;
    $periksa->biaya_periksa = $request->biaya_periksa;
    $periksa->save();

    // Update existing DetailPeriksa records (or create new ones if necessary)
    foreach ($request->obat as $obatId) {
      // Check if DetailPeriksa for this Periksa and Obat already exists
      $detail = DetailPeriksa::where('id_periksa', $periksa->id)
        ->where('id_obat', $obatId)
        ->first();

      if ($detail) {
        // If it exists, no need to create, just update if necessary
        // (you can add additional checks for other fields if needed)
        continue;
      }

      // If not found, create new DetailPeriksa entry
      DetailPeriksa::create([
        'id_periksa' => $periksa->id,
        'id_obat' => $obatId,
      ]);
    }

    return redirect()->route('dokter.periksa')->with('success', 'Periksa has been successfully updated.');
  }
}
