<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use App\Models\Nilai_alternatif;

class SAWController extends Controller
{
    public function calculateSAW()
    {
        // Ambil data kriteria beserta sub-kriterianya
        $kriteria = Kriteria::with('subkriteria')->get();
        
        // Ambil semua data balita
        $alternatifs = Balita::all();
        
        // Ambil nilai alternatif beserta sub-kriterianya
        $nilai_alternatif = Nilai_alternatif::with('sub_kriteria')->get();
        
        // Data untuk view
        $bobot_kriteria = $kriteria->pluck('bobot', 'id')->toArray();
        
        // Normalisasi
        $normalized = [];
        foreach ($kriteria as $k) {
            $maxValue = $nilai_alternatif->where('sub_kriteria.kriteria_id', $k->id)
                                          ->max(function($na) {
                                              return $na->sub_kriteria->nilai;
                                          });
            foreach ($nilai_alternatif->where('sub_kriteria.kriteria_id', $k->id) as $na) {
                $normalized[$na->balita_id][$k->id] = (float) $na->sub_kriteria->nilai / $maxValue;
            }
        }
        
        // Hitung nilai preferensi
        $preferensi = [];
        foreach ($normalized as $alt_id => $criteria) {
            $preferensi[$alt_id] = 0;
            foreach ($criteria as $k_id => $value) {
                $bobot = $kriteria->where('id', $k_id)->first()->bobot;
                $preferensi[$alt_id] += $value * (float) $bobot;
            }
        }
        
        // Hitung total nilai preferensi
        $total_preferensi = array_sum($preferensi);
        
        // Perangkingan
        arsort($preferensi);
        $ranking = array_keys($preferensi);

         // Tentukan hasil keputusan berdasarkan nilai preferensi
        $keputusan = [];
        foreach ($preferensi as $alt_id => $nilai) {
            $keputusan[$alt_id] = $nilai > 0.7 ? 'Normal' : 'Stanting';
        }
        
        return view('saw.result', compact('bobot_kriteria', 'normalized', 'preferensi', 'total_preferensi', 'ranking', 'alternatifs', 'nilai_alternatif', 'kriteria','keputusan'))->with([
            'user' => Auth::user(),
        ]);
    }
    
    
    
    
}
