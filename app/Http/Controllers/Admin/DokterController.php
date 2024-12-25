<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokterController extends Controller
{
  public function getDokter()
  {
    $dokters = Dokter::with('poli')->get();
    $polis = Poli::all();
    return view('admin.dokter', compact('polis', 'dokters'));
  }
  public function addDokter(Request $request)
  {
    $request->validate([
      'nama' => 'required|unique:dokters',
      'alamat' => 'required',
      'no_hp' => 'required|integer',
      'id_poli' => 'required|exists:polis,id',
    ]);
    try {
      Dokter::create($request->all());
      return redirect()->route('admin.dokter')->with('success', 'Dokter created successfully.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }
  public function updateDokter(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required|unique:dokters,nama,' . $id,
      'alamat' => 'required',
      'no_hp' => 'required|integer',
      'id_poli' => 'required|exists:polis,id',
    ]);
    try {
      Dokter::where('id', $id)->update([
        'nama' => $request['nama'],
        'alamat' => $request['alamat'],
        'no_hp' => $request['no_hp'],
        'id_poli' => $request['id_poli'],
      ]);
      return redirect()->route('admin.dokter')->with('success', 'Dokter updated successfully.');
    } catch (\Exception $th) {
      Log::error(($th->getMessage()));
      return back()->with('error', $th->getMessage());
    }
  }
  public function deleteDokter($id)
  {
    try {
      Dokter::where('id', $id)->delete();
      return redirect()->route('admin.dokter')->with('success', 'Dokter deleted successfully.');
    } catch (\Exception $th) {
      Log::error($th);
      return back()->with('error', 'Failed to delete dokter.');
    }
  }

  public function dashboard()
  {
    $jadwalPeriksas = JadwalPeriksa::all()->count();
    $daftarPolis = DaftarPoli::all()->count();
    $periksas = Periksa::all()->count();
    return view('dokter.dashboard', compact('jadwalPeriksas', 'daftarPolis', 'periksas'));
  }
}
