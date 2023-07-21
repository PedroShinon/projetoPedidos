<?php

namespace App\Filter\v1\ProductAttribute;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class ProductAttributeQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'lk'],
        'quantidade' => ['eq', 'ne', 'lk', 'gt', 'lt', 'gte', 'lte'],
        
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