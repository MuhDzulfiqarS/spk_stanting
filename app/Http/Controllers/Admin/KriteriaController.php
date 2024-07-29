<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kriteria;
use DataTables;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kriteria::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($kriterias) {
                $edit = route('editkriteria', $kriterias->id);
                $delete = route('kriteria.destroy', $kriterias->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$kriterias->id.'">
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
    return view('layout_kriteria.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $kriteria = Kriteria::all();
        return view ('layout_kriteria.create',compact(['kriteria']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        // Validate the input
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
            'keterangan' => 'required',
        ],[
            'nama_kriteria.required' => 'Nama kriteria wajib di isi',
            'bobot.required' => 'Bobot wajib di isi',
            'bobot.numeric' => 'Bobot harus berupa angka',
            'keterangan.required' => 'Keterangan wajib di isi',
        ]);
    
        // Convert the bobot to a percentage
        $bobot = $request->input('bobot');
        $percentageBobot = $bobot / 100; // Convert to percentage
    
        // Prepare the data, including the converted bobot
        $data = $request->except(['_token', 'submit']);
        $data['bobot'] = $percentageBobot;
    
        // Create the new Kriteria entry
        Kriteria::create($data);
    
        // Display success message and redirect
        toastr()->success('Berhasil menambahkan data');
        return redirect('kriteria')->with([
            'user' => Auth::user(),
        ]);
    }
    

    public function edit($id)
    {
        $kriteria = Kriteria::find($id); 
        return view('layout_kriteria.edit', compact('kriteria'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $kriteria = Kriteria::find($id); 
        $kriteria->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('kriteria')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }

}
