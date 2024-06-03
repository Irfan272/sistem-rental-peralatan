<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(){
        $jenis = Jenis::all();
        return view("admin.master_data.Jenis.index", compact("jenis"));
    }

    public function create(){
        return view("admin.master_data.Jenis.create");
    }

    public function store(Request $request){
        $validasiData = $request->validate([
            'nama_jenis' => 'required',
           
        ]);
       Jenis::create($validasiData);
        
        return redirect('/jenis')->with('success','Data Berhasil Ditambah');
    }

    public function edit($id){
        $jenis = Jenis::where('id', $id)->get();

        return view('admin.master_data.Jenis.edit', compact('jenis'));
    }

    public function update(Request $request, $id){
        $validasiData = $request->validate([
            'nama_jenis' => 'required',
        ]);

        Jenis::where('id', $id)->update($validasiData);

        return redirect('/jenis')->with('success','Data Berhasil Di Edit');
    }

    public function delete($id){
        Jenis::destroy($id);
        return redirect('/jenis')->with('success','Berhasil Dihapus');
    }

    public function view($id){
        $Jenis = Jenis::where('id', $id)->get();

        return view('admin.master_data.Jenis.view', compact('Jenis'));
    }
}
