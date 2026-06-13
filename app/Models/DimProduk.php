<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimProduk extends Model
{
        protected $table = 'dim_produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = ['id_produk'];
}
