<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = [
    'nama_produk',
    'kategori',
    'stok',
    'gambar',
];

// App/Models/Pinjem.php
// App/Models/Product.php
public function pinjams()
{
    return $this->hasMany(Pinjem::class, 'product_id');
}



}
