<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use App\Models\Nilai_alternatif;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel as Excel;
use App\Exports\KeputusanExport;
use App\Exports\KeputusanExportStunting;

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
    
        return view('layout_hasil_keputusan.index', compact('bobot_kriteria', 'normalized', 'preferensi', 'total_preferensi', 'ranking', 'alternatifs', 'nilai_alternatif', 'kriteria','keputusan'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new KeputusanExport, 'keputusan.xlsx');
    }

    public function exportExcelNormal()
    {
        $keputusan = $this->getKeputusanData(); // Mengambil semua data keputusan
        $keputusan = array_filter($keputusan, function($item) {
            return $item['hasil_keputusan'] === 'Normal';
        });
    
        return Excel::download(new KeputusanExport($keputusan), 'keputusan_normal.xlsx');
    }

    public function exportExcelStunting()
    {
        $keputusan = $this->getKeputusanData();
        $keputusan = array_filter($keputusan, function($item) {
            return $item['hasil_keputusan'] === 'Stanting';
        });
    
        return Excel::download(new KeputusanExport($keputusan), 'keputusan_stunting.xlsx');
    }
    
    
    public function exportPDF()
    {
        $keputusan = $this->getKeputusanData(); // Dapatkan data keputusan
        $pdf = PDF::loadView('exports.hasil_keputusan_pdf', compact('keputusan'));
        return $pdf->download('hasilkeputusan.pdf');
    }

    public function exportPDFNormal()
    {
        $keputusan = $this->getKeputusanData(); // Mengambil semua data keputusan
        $keputusan = array_filter($keputusan, function($item) {
            return $item['hasil_keputusan'] === 'Normal';
        });
        $pdf = PDF::loadView('exports.hasil_keputusan_normal_pdf', compact('keputusan'));
        return $pdf->download('hasilkeputusan_normal.pdf');
    }

    public function exportPDFStunting()
    {
        $keputusan = $this->getKeputusanData(); // Mengambil semua data keputusan
        $keputusan = array_filter($keputusan, function($item) {
            return $item['hasil_keputusan'] === 'Stanting';
        });
        $pdf = PDF::loadView('exports.hasil_keputusan_stunting_pdf', compact('keputusan'));
        return $pdf->download('hasilkeputusan_stunting.pdf');
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

    public function showNormal(Request $request)
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

    // Tentukan hasil keputusan berdasarkan nilai preferensi
    $keputusan = [];
    $rank = 1;
    foreach ($ranking as $alt_id) {
        if ($preferensi[$alt_id] > 0.7) { // Hanya tampilkan yang normal
            $keputusan[] = [
                'rank' => $rank++,
                'balita' => $alternatifs->find($alt_id)->nama_balita,
                'nilai_preferensi' => number_format($preferensi[$alt_id] * 100, 2),
                'hasil_keputusan' => 'Normal'
            ];
        }
    }

    if ($request->ajax()) {
        return datatables()->of($keputusan)
            ->addIndexColumn()
            ->make(true);
    }

    return view('layout_hasil_keputusan.normal', compact('keputusan'))->with([
        'user' => Auth::user(),
    ]);
}

public function showStunting(Request $request)
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

    // Tentukan hasil keputusan berdasarkan nilai preferensi
    $keputusan = [];
    $rank = 1;
    foreach ($ranking as $alt_id) {
        if ($preferensi[$alt_id] < 0.7) { // Hanya tampilkan yang stunting
            $keputusan[] = [
                'rank' => $rank++,
                'balita' => $alternatifs->find($alt_id)->nama_balita,
                'nilai_preferensi' => number_format($preferensi[$alt_id] * 100, 2),
                'hasil_keputusan' => 'Stunting'
            ];
        }
    }

    if ($request->ajax()) {
        return datatables()->of($keputusan)
            ->addIndexColumn()
            ->make(true);
    }

    return view('layout_hasil_keputusan.stunting', compact('keputusan'))->with([
        'user' => Auth::user(),
    ]);
}

    
}
