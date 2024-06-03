<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
        'pelanggan_id',
        'alat_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'tanggal_pengembalian',
        'lama_sewa', // baru
        'biaya_sewa',
        'denda_perhari',
        'status_pembayaran',
        'status_rental',
        'status_pengembalian',
        'total_pembayaran',
    ];

    public function Alat(){
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function Pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

   public function Pengembalian(){
        return $this->hasMany(Pengembalian::class, 'rental_id');
    }


}
