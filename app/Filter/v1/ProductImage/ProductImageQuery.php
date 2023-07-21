<?php

namespace App\Filter\v1\ProductImage;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class ProductImageQuery extends Filter {

    protected $safeParms = [
        'image' => ['eq', 'ne', 'lk']
    ];
    
    protected $columnMap = [
        'image' => 'image',
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like',
    ];

}