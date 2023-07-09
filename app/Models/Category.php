<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'image',
        'visivel',
    ];

    protected $casts = [
        'visivel' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    
}
