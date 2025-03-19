<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController {
    public function store(Request $request) {
        Absensi::create([ 'anggota_id' => auth()->id(), 'waktu_absen' => now() ]);
        return response()->json(['message' => 'Absen berhasil']);
    }
}
