<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Pelanggan;
use App\Models\Rental;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index(){
        $rental = Rental::with('Alat', 'Pelanggan')->get();
        return view("admin.transaksi.penyewaan.index", compact("rental"));
    }

    private function generate_unique_no_po()
    {
        $prefix = 'RT'; // Awalan untuk nomor PO (opsional)
        $last_po = Rental::max('id'); // Mendapatkan ID terakhir dari tabel Pembelian
    
        $seq_number = $last_po ? ($last_po + 1) : 1; // Nomor urut berdasarkan ID terakhir
        $no_po = "{$prefix}-{$seq_number}";
    
        return $no_po;
    }

    public function create(){
        $alat = Alat::where('status', 'Tersedia')->get();
        $pelanggan = Pelanggan::all();
        $no_po = $this->generate_unique_no_po();

        return view("admin.transaksi.penyewaan.create", compact("alat", "pelanggan", "no_po"));
    }

    public function store(Request $request){
        $request->validate([
            'no_invoice' => 'required',
            'pelanggan_id' => 'required',
            'alat_id' => 'required',
            'tanggal_sewa' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        // Mendapatkan status pembayaran dari request
    $status_pembayaran = $request->input('status_pembayaran');

    // Menentukan status rental berdasarkan status pembayaran
    $status_rental = $status_pembayaran === 'Belum Bayar' ? 'Tidak Aktif' : 'Aktif';

        $data = [
            'no_invoice' => $request->input('no_invoice'),
            'pelanggan_id' => $request->input('pelanggan_id'),
            'alat_id' => $request->input('alat_id'),
            'tanggal_sewa' => $request->input('tanggal_sewa'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
            'lama_sewa' => $request->input('lama_sewa'),
            'biaya_sewa' => $request->input('biaya_sewa'),
            'status_pembayaran' => $request->input('status_pembayaran'),
            'status_rental' => $status_rental,
            'status_pengembalian' => "",
            'total_pembayaran' => $request->input('biaya_sewa'),
        ];

        

        Rental::create($data);

        // Update status alat menjadi 'Tidak Tersedia' hanya jika status rental 'Aktif'
        if ($status_rental === 'Aktif') {
            $alat = Alat::find($request->input('alat_id'));
            if ($alat) {
                $alat->status = 'Tidak Tersedia';
                $alat->save();
            }
        }
        // Redirect dengan pesan sukses
        return redirect('/rental')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id){
        $rental = Rental::findOrFail($id);
        // $alat = Alat::where('status', 'Tersedia')->get();
        $alat = Alat::all();
        $pelanggan = Pelanggan::all();

        return view("admin.transaksi.penyewaan.edit", compact("alat", "pelanggan", "rental"));
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_invoice' => 'required|unique:rentals,no_invoice,' . $id,
            'pelanggan_id' => 'required',
            'alat_id' => 'required',
            'tanggal_sewa' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        // Mendapatkan status pembayaran dari request
    $status_pembayaran = $request->input('status_pembayaran');

    // Menentukan status rental berdasarkan status pembayaran
    $status_rental = $status_pembayaran === 'Belum Bayar' ? 'Tidak Aktif' : 'Aktif';

        $data = [
            'no_invoice' => $request->input('no_invoice'),
            'pelanggan_id' => $request->input('pelanggan_id'),
            'alat_id' => $request->input('alat_id'),
            'tanggal_sewa' => $request->input('tanggal_sewa'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
            'lama_sewa' => $request->input('lama_sewa'),
            'biaya_sewa' => $request->input('biaya_sewa'),
            'status_pembayaran' => $request->input('status_pembayaran'),
            'status_rental' => $status_rental,
            'status_pengembalian' => "",
            'total_pembayaran' => $request->input('biaya_sewa'),
        ];

        

        Rental::where('id', $id)->update($data);

        // Update status alat menjadi 'Tidak Tersedia' hanya jika status rental 'Aktif'
        if ($status_rental === 'Aktif') {
            $alat = Alat::find($request->input('alat_id'));
            if ($alat) {
                $alat->status = 'Tidak Tersedia';
                $alat->save();
            }
        }
        // Redirect dengan pesan sukses
        return redirect('/rental')->with('success', 'Data Berhasil Ditambah');
    }

    public function delete($id){
        Rental::destroy($id);
        return redirect('/rental')->with('success','Berhasil Dihapus');
    }


    public function kwintansi($id){
        $rental = Rental::findOrFail($id);
        // $alat = Alat::where('status', 'Tersedia')->get();
        $alat = Alat::all();
        $pelanggan = Pelanggan::all();

        return view("admin.transaksi.penyewaan.kwintansi", compact("alat", "pelanggan", "rental"));
    }



}
