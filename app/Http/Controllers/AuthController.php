<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController {
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
    
    public function login(Request $request) {
        // Login dengan token
    }
    public function logout(Request $request) {
        // Logout user
    }
    public function user(Request $request) {
        return response()->json(auth()->user());
    }
}


