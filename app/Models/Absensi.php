<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model {
    protected $fillable = ['anggota_id', 'waktu_absen'];
}