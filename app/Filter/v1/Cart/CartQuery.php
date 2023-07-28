<?php

namespace App\Filter\v1\Cart;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class CartQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'lk']
    ];
    
    protected $columnMap = [
        'nome' => 'nome',
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like',
    ];

}