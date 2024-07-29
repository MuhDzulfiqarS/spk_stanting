<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $fillable = ['nama_kriteria', 'bobot', 'keterangan'];

    public function subkriteria(): HasMany
    {
        return $this->hasMany(Sub_kriteria::class, 'kriteria_id');
    }
}
