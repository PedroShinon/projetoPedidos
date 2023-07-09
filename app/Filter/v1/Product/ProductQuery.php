<?php

namespace App\Filter\v1\Product;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class ProductQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'lk'],
        'marca' => ['eq', 'ne', 'lk'],
        'modelo' => ['eq', 'ne', 'lk'],
        'descricao' => ['eq', 'ne', 'lk'],
        'preco_atual' => ['eq', 'ne', 'lk', 'gt', 'lt', 'gte', 'lte'],
        'quantidade' => ['eq', 'ne', 'lk', 'gt', 'lt', 'gte', 'lte'],
        'destaque' => ['eq', 'ne'],
        'status' => ['eq', 'ne'],
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
        'lte' => '=<',
    ];

}