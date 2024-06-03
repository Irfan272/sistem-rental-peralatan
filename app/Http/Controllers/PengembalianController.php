<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Alat;
use App\Models\Pelanggan;
use App\Models\Rental;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(){
        $rental = Rental::with('Alat', 'Pelanggan')
        ->whereIn('status_rental', ['Aktif', 'Tidak Aktif'])
        ->get();

        return view("admin.transaksi.pengembalian.index", compact("rental"));
    }


    public function edit($id){
        $rental = Rental::findOrFail($id);
        // $alat = Alat::where('status', 'Tersedia')->get();
        $alat = Alat::all();
        $pelanggan = Pelanggan::all();

        return view("admin.transaksi.pengembalian.edit", compact("alat", "pelanggan", "rental"));
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_invoice' => 'required|unique:rentals,no_invoice,' . $id,
            // 'pelanggan_id' => 'required',
            // 'alat_id' => 'required',
            'tanggal_sewa' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        // Mendapatkan status pembayaran dari request
    $status_pengembalian = $request->input('status_pengembalian');

    // Menentukan status rental berdasarkan status pembayaran
    $status_rental = $status_pengembalian === 'Terlambat' || $status_pengembalian === 'Tepat Waktu' ? 'Tidak Aktif' : 'Tidak Aktif';

        $data = [
            'no_invoice' => $request->input('no_invoice'),
            // 'pelanggan_id' => $request->input('pelanggan_id'),
            // 'alat_id' => $request->input('alat_id'),
            'tanggal_sewa' => $request->input('tanggal_sewa'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
            'tanggal_pengembalian' => $request->input('tanggal_pengembalian'),
            'lama_sewa' => $request->input('lama_sewa'),
            'biaya_sewa' => $request->input('biaya_sewa'),
            
            // 'status_pembayaran' => $request->input('status_pembayaran'),
            'status_rental' => $status_rental,
            'status_pengembalian' => $request->input('status_pengembalian'),
            'denda_perhari' => $request->input('denda_perhari'),
            'total_pembayaran' => $request->input('total_pembayaran'),
        ];

        

        Rental::where('id', $id)->update($data);

        // Update status alat menjadi 'Tidak Tersedia' hanya jika status rental 'Aktif'
 
            $alat = Alat::find($request->input('alat_id'));
            if ($alat) {
                $alat->status = 'Tersedia';
                $alat->save();
            }
        
        // Redirect dengan pesan sukses
        return redirect('/pengembalian')->with('success', 'Data Berhasil Ditambah');
    }

    public function view($id){
        $rental = Rental::findOrFail($id);
        // $alat = Alat::where('status', 'Tersedia')->get();
        $alat = Alat::all();
        $pelanggan = Pelanggan::all();

        return view("admin.transaksi.pengembalian.view", compact("alat", "pelanggan", "rental"));
    }

    public function kwintansi($id){
        $rental = Rental::findOrFail($id);
        // $alat = Alat::where('status', 'Tersedia')->get();
        $alat = Alat::all();
        $pelanggan = Pelanggan::all();

        return view("admin.transaksi.pengembalian.kwintansi", compact("alat", "pelanggan", "rental"));
    }

    
}
