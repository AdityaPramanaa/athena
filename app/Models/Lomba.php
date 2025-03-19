<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model {
    protected $fillable = ['nama_lomba', 'deskripsi', 'link_pendaftaran'];
}