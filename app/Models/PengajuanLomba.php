<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanLomba extends Model {
    protected $fillable = ['anggota_id', 'nama_lomba', 'deskripsi', 'disetujui'];
}
