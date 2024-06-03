<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Pelanggan;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    public function index(){
        $alat = Alat::count();
        $pelanggan = Pelanggan::count();
        $rental = Rental::count();
        $pengembalian = Rental::whereIn('status_pengembalian', ['Terlambat', 'Tepat Waktu'])->count();

        // Menghitung jumlah rental per bulan
        $rentalPerMonth = Rental::selectRaw('YEAR(tanggal_sewa) as year, MONTH(tanggal_sewa) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderByRaw('year ASC, month ASC')
            ->get()
            ->mapWithKeys(function ($item) {
                return [Carbon::create($item->year, $item->month, 1)->format('Y-m') => $item->count];
            });

        // Menghitung jumlah pengembalian dengan status tepat waktu dan terlambat
        $pengembalianStatus = Rental::select('status_pengembalian', \DB::raw('count(*) as count'))
            ->whereIn('status_pengembalian', ['Tepat Waktu', 'Terlambat'])
            ->groupBy('status_pengembalian')
            ->pluck('count', 'status_pengembalian');

        // Menghitung top 5 alat yang sering dipinjam
        $topAlat = Rental::select('alat_id', DB::raw('count(alat_id) as count'))
            ->groupBy('alat_id')
            ->orderBy('count', 'desc')
            ->with('alat')
            ->take(5)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->alat->nama => $item->count];
            });

        return view("admin.dashboard", compact('rentalPerMonth', 'pengembalianStatus', 'topAlat', 'alat', 'pelanggan', 'rental', 'pengembalian'));
    }
}
