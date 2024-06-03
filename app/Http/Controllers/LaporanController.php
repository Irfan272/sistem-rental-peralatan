<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   // Method untuk menampilkan daftar alat
   public function cetakAlat()
   {
       $alat = Alat::all();
       return view("admin.laporan.cetak-alat", compact("alat"));
   }

   // Method untuk menampilkan laporan transaksi berdasarkan ID alat
   public function cetakAlatRiwayat($id)
   {
       $alat = Alat::findOrFail($id);
       $riwayat = Rental::with(['pelanggan', 'alat'])->where('alat_id', $id)->get();
       return view("admin.laporan.cetak-alat-detail", compact("alat", "riwayat"));
   }

   public function cetakRental(){
        return view("admin.laporan.cetak-rental");
   }

   public function cetakRentalPertanggal($tanggal_sewa, $tanggal_kembali)
   {
       $tanggal_mulai = Carbon::parse($tanggal_sewa)->format('d-m-Y');
       $tanggal_terakhir = Carbon::parse($tanggal_kembali)->format('d-m-Y');
          
       $rental = Rental::with(['Alat', 'Pelanggan'])->whereBetween('tanggal_sewa', [$tanggal_sewa, $tanggal_kembali])->get();
       
       $total = $rental->count();
       $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');
       
       return view('admin.laporan.cetak-rental-detail', compact('rental', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
   }

    public function cetakPengembalian(){
     return view("admin.laporan.cetak-pengembalian");
    }

    public function cetakPengembalianPertanggal($tanggal_sewa, $tanggal_pengembalian)
    {
       $tanggal_mulai = Carbon::parse($tanggal_sewa)->format('d-m-Y');
       $tanggal_terakhir = Carbon::parse($tanggal_pengembalian)->format('d-m-Y');

       $rental = Rental::with(['Alat', 'Pelanggan'])->whereBetween('tanggal_sewa', [$tanggal_sewa, $tanggal_pengembalian])->get();

       $total = $rental->count();
       $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

       return view('admin.laporan.cetak-pengembalian-detail', compact('rental', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }
   
   
}
