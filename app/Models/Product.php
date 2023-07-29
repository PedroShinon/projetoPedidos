<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria',
        'marca',
        'modelo',
        'preco_original',
        'preco_atual',
        'destaque',
        'user_id',
        'status'
    ];

    protected $casts = [
        'destaque' => 'boolean',
        'status' => 'boolean'
    ];

    public function productsCreator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }


}
