<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'attribute_id',
        'quantidade',
        'preco'
    ];

    public function pedido()
    {
        return $this->belongsTo(Order::class);
    }
}
