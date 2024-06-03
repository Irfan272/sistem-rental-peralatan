<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_id',
        'merk',
        'type',
        'harga_perhari',
        'denda_perhari',
        'status',
        'gambar_alat',
    ];

    public function Rental(){
        return $this->hasMany(Rental::class, 'alat_id');
    }

    public function Jenis(){
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }


    
}
