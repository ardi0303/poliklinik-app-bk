<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ObatController extends Controller
{
  public function getObat()
  {
    $obats = Obat::all();
    return view('admin.obat', compact('obats'));
  }
  public function addObat(Request $request)
  {
    $request->validate([
      'nama_obat' => 'required',
      'kemasan' => 'required',
      'harga' => 'required|integer',
    ]);
    try {
      Obat::create($request->all());
      return redirect()->route('admin.obat')->with('success', 'Obat created successfully.');
    } catch (\Exception $th) {
      Log::error($th);
      return back()->with('error', $th->getMessage());
    }
  }
  public function updateObat(Request $request, $id)
  {
    $request->validate([
      'nama_obat' => 'required',
      'kemasan' => 'required',
      'harga' => 'required|integer',
    ]);
    try {
      Obat::where('id', $id)->update([
        'nama_obat' => $request['nama_obat'],
        'kemasan' => $request['kemasan'],
        'harga' => $request['harga'],
      ]);
      return redirect()->route('admin.obat')->with('success', 'Obat updated successfully.');
    } catch (\Exception $th) {
      Log::error($th);
      return back()->with('error', $th->getMessage());
    }
  }
  public function deleteObat($id)
  {
    try {
      Obat::where('id', $id)->delete();
      return redirect()->route('admin.obat')->with('success', 'Obat deleted successfully.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', 'Failed to delete obat.');
    }
  }
}
