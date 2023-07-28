<?php

namespace App\Filter\v1\Order;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class OrderQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'lk'],
        'user_id' => ['eq', 'ne', 'lk'],
        'loja_id' => ['eq', 'ne', 'lk'],
        'tracking_code' => ['eq', 'ne', 'lk'],
        'pincode' => ['eq', 'ne', 'lk'],
        'nome_completo' => ['eq', 'ne', 'lk'],
        'endereco' => ['eq', 'ne', 'lk'],
        'email' => ['eq', 'ne', 'lk'],
        'numero_tel' => ['eq', 'ne', 'lk'],
        'status_pedidos' => ['eq', 'ne', 'lk'],
        'quantidade' => ['eq', 'ne', 'lk', 'gt', 'lt', 'gte', 'lte'],
        'preco_total' => ['eq', 'ne', 'lk', 'gt', 'lt', 'gte', 'lte'],
    ];
    
    protected $columnMap = [
        'nome' => 'nome',
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like',
        'gt' => '>',
        'lt' => '<',
        'gte' => '>=',
        'lte' => '<=',
    ];

}