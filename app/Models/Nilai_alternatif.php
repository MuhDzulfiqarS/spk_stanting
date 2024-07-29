<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai_alternatif extends Model
{
    use HasFactory;
    protected $table = 'nilai_alternatifs';
    protected $fillable = ['balita_id', 'sub_kriteria_id'];

        /**
     * Get the user that owns the Kriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_kriteria(): BelongsTo
    {
        return $this->belongsTo(Sub_kriteria::class, 'sub_kriteria_id');
    }

            /**
     * Get the user that owns the Alternatif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class, 'balita_id');
    }
}
