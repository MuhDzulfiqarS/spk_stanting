<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\Sub_kriteria;
use App\Models\Nilai_alternatif;
use DataTables;

class NilaiAlternatifController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nilai_alternatif::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('subkriteria', function ($nilai_alternatifs) {
                return $nilai_alternatifs->sub_kriteria->nama_subkriteria ?? '';
            })
            ->addColumn('alternatif', function ($nilai_alternatifs) {
                return $nilai_alternatifs->balita->nama_balita ?? '';
            })
            ->addColumn('action', function ($nilai_alternatifs) {
                $edit = route('editnilai_alternatif', $nilai_alternatifs->id);
                $delete = route('nilai_alternatif.destroy', $nilai_alternatifs->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$nilai_alternatifs->id.'">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                ';
                
                return '<a href="'.$edit.'" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> 
                    <form action="'.$delete.'" method="POST" style="display:inline;">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        '.$deleteButton.'
                    </form>';
            })
            ->toJson();
        }
    return view('layout_nilai_alternatif.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $nilai_alternatif = Nilai_alternatif::all();
        $sub_kriteria = Sub_kriteria::all();
        $balita = Balita::all();
        return view ('layout_nilai_alternatif.create',compact(['nilai_alternatif','sub_kriteria','balita']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'sub_kriteria_id'=>'required',
            'balita_id'=>'required',
           
        ],[
            'sub_kriteria_id.required' =>'Anda harus memilih sub kriteria',
            'balita_id.required' =>'Anda harus memilih balita',
           
        ]);
        $data = $request->except(["_token","submit"]);
        Nilai_alternatif::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('nilai_alternatif')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $nilai_alternatif = Nilai_alternatif::find($id); 
        $sub_kriteria = Sub_kriteria::all();
        $balita = Balita::all();
        return view('layout_nilai_alternatif.edit', compact('nilai_alternatif','sub_kriteria','balita'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $nilai_alternatif = Nilai_alternatif::find($id); 
        $nilai_alternatif->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('nilai_alternatif')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $nilai_alternatif = Nilai_alternatif::find($id);
        $nilai_alternatif->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }
}
