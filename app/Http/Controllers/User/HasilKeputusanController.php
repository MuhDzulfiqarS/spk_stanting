<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use App\Models\Nilai_alternatif;
use DataTables;
use PDF;
use Excel;
use App\Exports\KeputusanExport;

class HasilKeputusanController extends Controller
{
    public function index(Request $request)
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
         $rank = 1;
         foreach ($ranking as $alt_id) {
             $keputusan[] = [
                 'rank' => $rank++,
                 'balita' => $alternatifs->find($alt_id)->nama_balita,
                 'nilai_preferensi' => number_format($preferensi[$alt_id] * 100, 2),
                 'hasil_keputusan' => $preferensi[$alt_id] > 0.7 ? 'Normal' : 'Stanting'
             ];
         }
    
        if ($request->ajax()) {
            return datatables()->of($keputusan)
                ->addIndexColumn()
                ->make(true);
        }
    
        return view('layout_hasil_keputusan_user.index', compact('bobot_kriteria', 'normalized', 'preferensi', 'total_preferensi', 'ranking', 'alternatifs', 'nilai_alternatif', 'kriteria','keputusan'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new KeputusanExport, 'keputusan.xlsx');
    }

    public function exportPDF()
    {
        $keputusan = $this->getKeputusanData(); // Dapatkan data keputusan
        $pdf = PDF::loadView('exports.hasil_keputusan_pdf_user', compact('keputusan'));
        return $pdf->download('hasilkeputusan.pdf');
    }

    protected function getKeputusanData()
    {
        // Fungsi ini untuk mendapatkan data keputusan, sama seperti yang ada di fungsi index
        // (dapat di-refactor ke dalam fungsi terpisah jika diperlukan)
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
