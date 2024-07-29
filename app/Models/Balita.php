<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;
    protected $table = 'balitas';
    protected $fillable = ['nama_balita', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'nama_orangtua'];
}
