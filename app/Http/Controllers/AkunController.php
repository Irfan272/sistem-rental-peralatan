<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index(){
        $akun = User::all();
        return view("admin.master_data.akun.index", compact("akun"));
    }

    private function generate_unique_no_po()
    {
        $prefix = 'MT'; // Awalan untuk nomor PO (opsional)
        $last_po = Alat::max('id'); // Mendapatkan ID terakhir dari tabel Pembelian
    
        $seq_number = $last_po ? ($last_po + 1) : 1; // Nomor urut berdasarkan ID terakhir
        $kd_alat = "{$prefix}-{$seq_number}";
    
        return $kd_alat;
    }

    public function create(){
        $kd_alat = $this->generate_unique_no_po();
        $kategori = Kategori::all();
        return view("admin.master_data.alat.create", compact("kd_alat","kategori"));
    }

    public function store(Request $request){
        $validasiData = $request->validate([
            'kd_alat' => 'required',
            'kategori_id' => 'required',
            'nama_alat' => 'required',
            'harga_rental_perhari' => 'required',
        ]);
        $validasiData['status'] = "Aktif";

       Alat::create($validasiData);
        
        return redirect('/alat')->with('success','Data Berhasil Ditambah');
    }

    public function edit($id){
        $alat = alat::where('id', $id)->get();

        return view('admin.master_data.alat.edit', compact('alat'));
    }

    public function update(Request $request, $id){
        $validasiData = $request->validate([
            'nama_alat' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        alat::where('id', $id)->update($validasiData);

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
