<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'kode_pelanggan',
        'nama_pelanggan',
        'jenis_kelamin',
        'kota',
    ];
}
