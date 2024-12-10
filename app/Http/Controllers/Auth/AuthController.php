<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }
  public function register()
  {
    return view('auth.register');
  }

  public function handleLogin(Request $request)
  {
    $request->validate([
      'nama' => 'required|string',
      'alamat' => 'required|string',
    ]);
    $credentials = $request->only('nama', 'alamat');

    if ($this->authenticateAdmin($credentials['nama'], $credentials['alamat'])) {
      session(['isAdmin' => true]);
      return redirect()->route('admin.dashboard');
    }

    $pasien = Pasien::where('nama', $request->nama)
      ->where('alamat', $request->alamat)
      ->first();
    if ($pasien) {
      auth()->guard('pasien')->login($pasien);
      return redirect()->route('pasien.dashboard');
    }

    $dokter = Dokter::where('nama', $request->nama)
      ->where('alamat', $request->alamat)
      ->first();
    if ($dokter) {
      auth()->guard('dokter')->login($dokter);
      return redirect()->route('dokter.dashboard');
    }
    return back()->withErrors(['login' => 'Invalid credentials.']);
  }

  public function handleRegisterPasien(Request $request)
  {
    $request->validate([
      'nama' => 'required|unique:pasiens',
      'alamat' => 'required',
      'no_ktp' => 'required',
      'no_hp' => 'required',
    ]);


    try {
      $lastPasien = Pasien::latest()->first();
      $newId = $lastPasien ? $lastPasien->id + 1 : 1;

      // no_rm adalah tahun bulan, no urut ex 202411-01
      $request['no_rm'] = date('ym') . '-' . $newId;
      $pasien = Pasien::create($request->all());
      auth()->guard('pasien')->login($pasien);
      return redirect()->route('pasien.dashboard')->with('success', 'Registered successfully.');
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      return back()->with('error', $th->getMessage());
    }
  }

  public function handleLogout()
  {
    if (session()->has('isAdmin')) {
      session()->forget('isAdmin');
    }

    Auth::guard('dokter')->logout();
    Auth::guard('pasien')->logout();

    return redirect()->route('loginForm');
  }

  private function authenticateAdmin($nama, $alamat)
  {
    $admins = [
      ['nama' => 'admin', 'alamat' => 'admin'],
    ];

    foreach ($admins as $admin) {
      if ($admin['nama'] === $nama && $admin['alamat'] === $alamat) {
        return true;
      }
    }

    return false;
  }
}
