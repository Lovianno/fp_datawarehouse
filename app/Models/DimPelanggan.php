<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimPelanggan extends Model
{
    protected $table = 'dim_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $guarded = ['id_pelanggan'];
}
