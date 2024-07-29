<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balita;
use DataTables;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Balita::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($balitas) {
                $edit = route('editbalita', $balitas->id);
                $delete = route('balita.destroy', $balitas->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$balitas->id.'">
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
    return view('layout_balita.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $balita = Balita::all();
        return view ('layout_balita.create',compact(['balita']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama_balita'=>'required',       
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'nama_orangtua'=>'required',  
        ],[
            'nama_balita.required' => 'Nama balita wajib di isi',
            'jenis_kelamin.required' => 'Anda harus memilih jenis kelamin',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid',
            'tempat_lahir.required' => 'Tempat lahir wajib di isi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib di isi',
            'nama_orangtua.required' => 'Nama orang tua wajib di isi',
        ]);
        $data = $request->except(["_token","submit"]);
        Balita::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('balita')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $balita = Balita::find($id); 
        return view('layout_balita.edit', compact('balita'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $balita = Balita::find($id); 
        $balita->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('balita')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $balita = Balita::find($id);
        $balita->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }
}
