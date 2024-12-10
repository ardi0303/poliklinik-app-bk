<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
  public function login()
  {
    return view('admin.login');
  }
  public function handleLogin(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'alamat' => 'required',
    ]);

    if ($request->nama === 'admin' && $request->alamat === 'admin') {
      session(['isAdmin' => true]);
      return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.loginForm')->with('error', 'Invalid credentials.');
  }
  public function handleLogout()
  {
    session()->forget('isAdmin');
    return redirect()->route('admin.loginForm')->with('success', 'Logged out successfully.');
  }
  public function dashboard()
  {
    $dokters = Dokter::all()->count();
    $pasiens = Pasien::all()->count();
    $polis = Poli::all()->count();
    $obats = Obat::all()->count();
    return view('admin.dashboard', compact('dokters', 'pasiens', 'polis', 'obats'));
  }
}
