<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
  public function getPasien()
  {
    $pasiens = Pasien::all();

    $lastPasien = Pasien::latest();
    $newId = $lastPasien ? $lastPasien->count() + 1 : 1;
    $no_rm = date('Ym') . '-' . sprintf('%03d', $newId);

    return view('admin.pasien', compact('pasiens', 'no_rm'));
  }

  public function addPasien(Request $request)
  {
    $request->validate([
      'nama' => 'required|unique:pasiens',
      'alamat' => 'required',
      'no_ktp' => 'required|integer',
      'no_hp' => 'required|integer',
      'no_rm' => 'required',
    ]);

    try {
      Pasien::create($request->all());
      return redirect()->route('admin.pasien')->with('success', 'Pasien created successfully.');
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }

  public function edit(Pasien $pasien)
  {
    return view('pasien.edit', compact('pasien'));
  }

  public function updatePasien(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required|unique:pasiens,nama,' . $id,
      'alamat' => 'required',
      'no_ktp' => 'required|integer',
      'no_hp' => 'required|integer',
      'no_rm' => 'required',
    ]);
    try {
      Pasien::where('id', $id)->update([
        'nama' => $request['nama'],
        'alamat' => $request['alamat'],
        'no_ktp' => $request['no_ktp'],
        'no_hp' => $request['no_hp'],
        'no_rm' => $request['no_rm'],
      ]);
      return redirect()->route('admin.pasien')->with('success', 'Pasien updated successfully.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }

  public function deletePasien($id)
  {
    try {
      Pasien::where('id', $id)->delete();
      return redirect()->route('admin.pasien')->with('success', 'Pasien deleted successfully.');
    } catch (\Exception $th) {
      Log::error($th);
      return back()->with('error', 'Failed to delete pasien.');
    }
  }
}
