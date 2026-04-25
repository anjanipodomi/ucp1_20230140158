<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', // field name boleh diisi lewat form tambah/edit category
    ];

    public function products()
    {
        return $this->hasMany(Product::class); // satu category bisa punya banyak product
    }
}