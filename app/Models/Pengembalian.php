<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $fillable = [
        'rental_id',
        'tanggal_pengembalian',
        'kondisi_alat',
        'denda',
    ];

    public function Rental(){
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}
