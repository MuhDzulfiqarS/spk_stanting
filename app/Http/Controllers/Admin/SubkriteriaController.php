<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Kriteria;
use App\Models\Sub_kriteria;
use DataTables;

class SubkriteriaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sub_kriteria::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kriteria', function ($sub_kriterias) {
                return $sub_kriterias->kriteria->nama_kriteria ?? '';
            })
            ->addColumn('action', function ($sub_kriterias) {
                $edit = route('editsub_kriteria', $sub_kriterias->id);
                $delete = route('sub_kriteria.destroy', $sub_kriterias->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$sub_kriterias->id.'">
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
    return view('layout_sub_kriteria.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $sub_kriteria = Sub_kriteria::all();
        $kriteria = Kriteria::all();
        return view ('layout_sub_kriteria.create',compact(['sub_kriteria','kriteria']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'kriteria_id'=>'required',
            'nama_subkriteria'=>'required',
            'nilai'=>'required',
           
        ],[
            'kriteria_id.required' =>'Anda harus memilih kriteria',
            'nama_subkriteria.required' => 'Nama Sub Kriteria wajib di isi',
            'nilai.required' => 'Nilai wajib di isi',
           
        ]);
        $data = $request->except(["_token","submit"]);
        Sub_kriteria::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('sub_kriteria')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $sub_kriteria = Sub_kriteria::find($id); 
        $kriteria = Kriteria::all();
        return view('layout_sub_kriteria.edit', compact('sub_kriteria','kriteria'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $sub_kriteria = Sub_kriteria::find($id); 
        $sub_kriteria->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('sub_kriteria')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $sub_kriteria = Sub_kriteria::find($id);
        $sub_kriteria->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }
}
