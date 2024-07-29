<?php
namespace App\Helpers;

use App\Models\Kriteria;
use App\Models\NilaiAlternatif;

class SAWHelper
{
    public static function calculateSAW()
    {
        $kriteria = Kriteria::all();
        $nilai_alternatif = Nilai_alternatif::all();
        
        // Normalisasi matriks
        $normalized = [];
        foreach ($kriteria as $k) {
            $sum = $nilai_alternatif->where('kriteria_id', $k->id)->sum('nilai');
            foreach ($nilai_alternatif->where('kriteria_id', $k->id) as $na) {
                $normalized[$na->alternatif_id][$k->id] = $na->nilai / $sum;
            }
        }

        // Perhitungan nilai preferensi
        $result = [];
        foreach ($normalized as $alt_id => $criteria) {
            $result[$alt_id] = 0;
            foreach ($criteria as $k_id => $value) {
                $bobot = $kriteria->where('id', $k_id)->first()->bobot;
                $result[$alt_id] += $value * $bobot;
            }
        }

        return $result;
    }
}
