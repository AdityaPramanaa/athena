<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Anggota;
use App\Models\Pengurus;

class AuthController extends Controller
{
    // 📌 Pendaftaran Anggota
    public function register(Request $request) {
        $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:anggota,nim',
            'prodi' => 'required|string',
            'angkatan' => 'required|string',
            'foto_ktm' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto_ktm')->store('public/ktm');

        Anggota::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'foto_ktm' => $path,
        ]);

        return response()->json(['message' => 'Pendaftaran berhasil, menunggu verifikasi']);
    }

    // 📌 Pendaftaran Pengurus
    public function registerPengurus(Request $request) {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:pengurus,email',
            'password' => 'required|string|min:6',
            'jabatan' => 'required|string',
        ]);

        Pengurus::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), // 🔹 Enkripsi password
            'jabatan' => $request->jabatan,
        ]);

        return response()->json(['message' => 'Pengurus berhasil didaftarkan']);
    }

    // 📌 Login (Anggota & Pengurus)
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $pengurus = Pengurus::where('email', $request->email)->first();
        
        if ($pengurus && Hash::check($request->password, $pengurus->password)) {
            $token = $pengurus->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Login berhasil',
                'token' => $token,
                'user' => $pengurus
            ]);
        }

        return response()->json(['error' => 'Email atau password salah'], 401);
    }

    // 📌 Ambil Data User
    public function user(Request $request) {
        return response()->json(auth()->user());
    }

    // 📌 Logout
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    }
}
