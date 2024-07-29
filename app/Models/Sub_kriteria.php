<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sub_kriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_kriterias';
    protected $fillable = ['kriteria_id', 'nama_subkriteria', 'nilai'];

            /**
     * Get the user that owns the Data_kelurahan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
