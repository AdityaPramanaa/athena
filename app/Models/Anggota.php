<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model {
    protected $fillable = ['nama', 'nim', 'prodi', 'angkatan', 'jabatan', 'foto_ktm', 'disetujui'];
}
