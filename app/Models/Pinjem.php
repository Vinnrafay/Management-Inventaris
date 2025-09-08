<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjem extends Model
{
   protected $fillable = [
    'product_id',
    'nama_peminjam',
    'waktu_pinjam',
    'waktu_kembali',
];

public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
