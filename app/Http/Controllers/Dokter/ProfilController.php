<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfilController extends Controller
{
  public function getProfil()
  {
    $dokter = Dokter::with('poli')->find(auth()->guard('dokter')->id());
    $polis = Poli::all();
    return view('dokter.profil', compact('dokter', 'polis'));
  }

  public function updateProfil(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'alamat' => 'required',
      'no_hp' => 'required|integer',
      // 'id_poli' => 'required|exists:polis,id',
    ]);
    try {
      Dokter::where('id', auth()->guard('dokter')->id())->update([
        'nama' => $request['nama'],
        'alamat' => $request['alamat'],
        'no_hp' => $request['no_hp'],
        // 'id_poli' => $request['id_poli'],
      ]);
      return redirect()->route('dokter.profil')->with('success', 'Profil updated successfully.');
    } catch (\Exception $th) {
      Log::error(($th->getMessage()));
      return back()->with('error', $th->getMessage());
    }
  }
}
