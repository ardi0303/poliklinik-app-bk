<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PoliController extends Controller
{
  public function getPoli()
  {
    $polis = Poli::all();
    return view('admin.poli', compact('polis'));
  }
  public function addPoli(Request $request)
  {
    $request->validate([
      'nama_poli' => 'required',
      'keterangan' => 'required',
    ]);
    try {
      Poli::create($request->all());
      return redirect()->route('admin.poli')->with('success', 'Poli created successfully.');
    } catch (\Exception $th) {
      Log::error($th);
      return back()->with('error', $th->getMessage());
    }
  }
  public function updatePoli(Request $request, $id)
  {
    $validated = $request->validate([
      'nama_poli' => 'required',
      'keterangan' => 'required',
    ]);
    try {
      Poli::where('id', $id)->update([
        'nama_poli' => $validated['nama_poli'],
        'keterangan' => $validated['keterangan'],
      ]);
      return redirect()->route('admin.poli')->with('success', 'Poli updated successfully.');
    } catch (\Exception $th) {
      Log::error($th);
      return back()->with('error', $th->getMessage());
    }
  }
  public function deletePoli($id)
  {
    try {
      Poli::where('id', $id)->delete();
      return redirect()->route('admin.poli')->with('success', 'Poli deleted successfully.');
    } catch (\Exception $th) {
      Log::error($th->getMessage());
      return back()->with('error', 'Failed to delete poli.');
    }
  }
}
