<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loja_id',
        'tracking_code',
        'nome_completo',
        'endereco',
        'email',
        'numero_tel',
        'pincode',
        'status_pedidos',
        'quantidade',
        'preco_total'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
