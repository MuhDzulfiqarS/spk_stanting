<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_orangtua extends Model
{
    use HasFactory;
    protected $table = 'data_orangtuas';
    protected $fillable = ['nama_orangtua', 'pekerjaan', 'no_hp', 'alamat'];
}
