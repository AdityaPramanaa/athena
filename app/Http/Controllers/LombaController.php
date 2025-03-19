<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LombaController {
    public function index() {
        return response()->json(Lomba::all());
    }
    public function ajukanLomba(Request $request) {
        PengajuanLomba::create([
            'anggota_id' => auth()->id(),
            'nama_lomba' => $request->nama_lomba,
            'deskripsi' => $request->deskripsi,
        ]);
        return response()->json(['message' => 'Pengajuan lomba berhasil']);
    }
    public function kelola() {
        return response()->json(PengajuanLomba::all());
    }
}
