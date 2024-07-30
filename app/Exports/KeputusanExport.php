<?php

namespace App\Exports;

use App\Models\Keputusan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Balita;
use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use App\Models\Nilai_alternatif;

class KeputusanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // Dapatkan data keputusan
       $keputusan = $this->getKeputusanData();
        
       // Konversi data keputusan menjadi collection
       $data = collect($keputusan)->map(function($item) {
           return [
               'rank' => $item['rank'],
               'balita' => $item['balita'],
               'nilai_preferensi' => $item['nilai_preferensi'],
               'hasil_keputusan' => $item['hasil_keputusan']
           ];
       });

       return $data;
    }

    public function headings(): array
    {
        return [
            'Rank',
            'Balita',
            'Nilai Preferensi (%)',
            'Hasil Keputusan'
        ];
    }

    protected function getKeputusanData()
    {
        // Ambil data kriteria beserta sub-kriterianya
        $kriteria = Kriteria::with('subkriteria')->get();
        
        // Ambil semua data balita
        $alternatifs = Balita::all();
        
        // Ambil nilai alternatif beserta sub-kriterianya
        $nilai_alternatif = Nilai_alternatif::with('sub_kriteria')->get();
        
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
        
        // Perangkingan
        arsort($preferensi);
        $ranking = array_keys($preferensi);

        // Tentukan hasil keputusan berdasarkan nilai preferensi dan perangkingan
        $keputusan = [];
        $rank = 1;
        foreach ($ranking as $alt_id) {
            $keputusan[] = [
                'rank' => $rank++,
                'balita' => $alternatifs->find($alt_id)->nama_balita,
                'nilai_preferensi' => number_format($preferensi[$alt_id] * 100, 2),
                'hasil_keputusan' => $preferensi[$alt_id] > 0.7 ? 'Normal' : 'Stanting'
            ];
        }

        return $keputusan;
    }
}
