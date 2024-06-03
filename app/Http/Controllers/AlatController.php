<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\jenis;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index(){
        $alat = Alat::with('jenis')->get();
        return view("admin.master_data.alat.index", compact("alat"));
    }

    public function create(){
        $jenis = Jenis::all();
        return view("admin.master_data.alat.create", compact("jenis"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_id' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'harga_perhari' => 'required',
            'denda_perhari' => 'required',
            'gambar_alat' => 'required',
        ]);

        $data = [
            'jenis_id' => $request->input('jenis_id'),
            'merk' => $request->input('merk'),
            'type' => $request->input('type'),
            'harga_perhari' => $request->input('harga_perhari'),
            'denda_perhari' => $request->input('denda_perhari'),
            'gambar_alat' => $request->input('gambar_alat'),
            'status' => "Tersedia",
        ];

        // Menyimpan data ke dalam database menggunakan model Alat
        Alat::create($data);

        // Redirect dengan pesan sukses
        return redirect('/alat')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id){
        $jenis = Jenis::all();
        $alat = Alat::findOrFail($id);

        return view('admin.master_data.alat.edit', compact('alat', 'jenis'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'jenis_id' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'harga_perhari' => 'required',
            'denda_perhari' => 'required',
            'gambar_alat' => 'required',
        ]);

        $data = [
            'jenis_id' => $request->input('jenis_id'),
            'merk' => $request->input('merk'),
            'type' => $request->input('type'),
            'harga_perhari' => $request->input('harga_perhari'),
            'denda_perhari' => $request->input('denda_perhari'),
            'gambar_alat' => $request->input('gambar_alat'),
            'status' => "Tersedia",
        ];

        alat::where('id', $id)->update($data);

        return redirect('/alat')->with('success','Data Berhasil Di Edit');
    }

    public function delete($id){
        alat::destroy($id);
        return redirect('/alat')->with('success','Berhasil Dihapus');
    }

    public function view($id){
        $alat = alat::where('id', $id)->get();

        return view('admin.master_data.alat.view', compact('alat'));
    }
}
