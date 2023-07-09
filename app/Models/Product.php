<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'marca',
        'modelo',
        'descricao',
        'preco_atual',
        'destaque',
        'status'
    ];

    protected $casts = [
        'destque' => 'boolean',
        'status' => 'boolean'
    ];

    public function products()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
