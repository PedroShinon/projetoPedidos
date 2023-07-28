<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'attributo',
        'image',
        'attribute_id',
        'quantidade'
    ];
    

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
