<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalPeriksaController extends Controller
{
  public function getJadwalPeriksa()
  {
    $id_dokter = Auth::guard('dokter')->id();
    $nama_dokter = Auth::guard('dokter')->user()->nama;

    // Mengambil data JadwalPeriksa berdasarkan id_dokter
    $jadwalPeriksas = JadwalPeriksa::with('dokter')
      ->where('id_dokter', $id_dokter)
      ->get();

    return view('dokter.jadwalPeriksa', compact('jadwalPeriksas', 'nama_dokter'));
  }

  public function addJadwalPeriksa(Request $request)
  {
    $request->validate([
      'hari' => 'required',
      'jam_mulai' => 'required',
      'jam_selesai' => 'required',
      'status' => 'required',
    ]);

    $id_dokter = Auth::guard('dokter')->id();

    try {
      if ($request->status === 'Aktif') {
        JadwalPeriksa::where('id_dokter', $id_dokter)
          ->update(['status' => 'Tidak Aktif']);
      }
      JadwalPeriksa::create([
        'id_dokter' => $id_dokter,
        'hari' => $request->hari,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'status' => $request->status,
      ]);
      return redirect()->route('dokter.jadwal-periksa')->with('success', 'Jadwal periksa has been successfully added.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }

  public function updateJadwalPeriksa(Request $request, $id)
  {
    $request->validate([
      'hari' => 'required',
      'jam_mulai' => 'required',
      'jam_selesai' => 'required',
      'status' => 'required',
    ]);

    try {
      $jadwal = JadwalPeriksa::findOrFail($id);

      if ($request->status === 'Aktif') {
        JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
          ->where('id', '!=', $jadwal->id)
          ->update(['status' => 'Tidak Aktif']);
      }

      $jadwal->update([
        'hari' => $request->hari,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'status' => $request->status,
      ]);

      return redirect()->route('dokter.jadwal-periksa')->with('success', 'Jadwal periksa has been successfully updated.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }

  public function deleteJadwalPeriksa($id)
  {
    try {
      JadwalPeriksa::where('id', $id)->delete();
      return redirect()->route('dokter.jadwal-periksa')->with('success', 'Jadwal periksa has been successfully deleted.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }
}
