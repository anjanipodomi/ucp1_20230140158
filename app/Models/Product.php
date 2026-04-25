<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    // FIELD YANG BOLEH DIISI (WAJIB untuk create & update)
    protected $fillable = [
        'name',
        'qty',
        'price',
        'user_id',
        'category_id', // ini supaya category bisa disimpan saat create/update product
    ];

    // RELASI KE USER (OWNER)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class); // setiap product punya 1 category
    }
}
