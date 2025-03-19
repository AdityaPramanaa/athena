<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController {
    public function index() {
        return response()->json(Anggota::all());
    }
    public function verifikasi($id) {
        $anggota = Anggota::findOrFail($id);
        $anggota->disetujui = true;
        $anggota->save();
        return response()->json(['message' => 'Anggota diverifikasi.']);
    }
}
