<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Data_orangtua;
use DataTables;

class DataOrangTuaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = data_orangtua::select('*');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data_orangtuas) {
                $edit = route('editdata_orangtua', $data_orangtuas->id);
                $delete = route('data_orangtua.destroy', $data_orangtuas->id);
                $deleteButton = '
                    <button class="btn btn-secondary btn-sm delete-button" data-id="'.$data_orangtuas->id.'">
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
    return view('layout_data_orangtua.index')->with([
            'user' => Auth::user(),
            ]);
    }

    public function create(){
        $data_orangtua = data_orangtua::all();
        return view ('layout_data_orangtua.create',compact(['data_orangtua']))->with([
            'user' => Auth::user(),
         ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama_orangtua'=>'required',
            'pekerjaan'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
           
        ],[
            'nama_orangtua.required' =>'Nama orang tua wajib di isi',
            'pekerjaan.required' =>'Pekerjaan wajib di isi',
            'no_hp.required' =>'No HP wajib di isi',
            'alamat.required' =>'Alamat wajib di isi',
           
        ]);
        $data = $request->except(["_token","submit"]);
        Data_orangtua::create($data);
        toastr()->success('Berhasil menambahkan data');
        return redirect('data_orangtua')->with([
            'user' => Auth::user(),
         ]);
    }

    public function edit($id)
    {
        $data_orangtua = Data_orangtua::find($id); 
        return view('layout_data_orangtua.edit', compact('data_orangtua'))->with([
            'user' => Auth::user(),
         ]);
    }

    public function update($id, Request $request)
    {
        $data_orangtua = Data_orangtua::find($id); 
        $data_orangtua->update($request->except(['_token','submit']));
        toastr()->success('Data berhasil di Update');
        return redirect('data_orangtua')->with([
            'user' => Auth::user(),
         ]);
    }

    public function destroy($id)
    {
        $data_orangtua = Data_orangtua::find($id);
        $data_orangtua->delete();
        return response()->json([
            'user' => Auth::user(),
            'success' => 'Data berhasil di Delete'
         ]);
    }
}
