<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggan = Pelanggan::all();
        return view("admin.master_data.pelanggan.index", compact("pelanggan"));
    }

    public function create(){
        return view("admin.master_data.pelanggan.create");
    }

    public function store(Request $request){
        $validasiData = $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);
       Pelanggan::create($validasiData);
        
        return redirect('/pelanggan')->with('success','Data Berhasil Ditambah');
    }

    public function edit($id){
        $pelanggan = Pelanggan::where('id', $id)->get();

        return view('admin.master_data.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id){
        $validasiData = $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        Pelanggan::where('id', $id)->update($validasiData);

        return redirect('/pelanggan')->with('success','Data Berhasil Di Edit');
    }

    public function delete($id){
        Pelanggan::destroy($id);
        return redirect('/pelanggan')->with('success','Berhasil Dihapus');
    }

    public function view($id){
        $pelanggan = Pelanggan::where('id', $id)->get();

        return view('admin.master_data.pelanggan.view', compact('pelanggan'));
    }
}
