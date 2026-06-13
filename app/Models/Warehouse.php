<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'last_extracted_at',
    ];

    protected function casts()
    {
        return [
            'last_extracted_at' => 'datetime',
        ];
    }
}
