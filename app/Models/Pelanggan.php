<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_telpon',
        'email',

    ];

    public function Rental(){
        return $this->hasMany(Rental::class, 'pelanggan_id');
    }
}
