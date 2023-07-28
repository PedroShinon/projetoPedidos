<?php

namespace App\Filter\v1\Banner;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class BannerQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'lk'],
        'image' => ['eq', 'ne', 'lk']
    ];
    
    protected $columnMap = [
        'image' => 'image',
        'nome' => 'nome'
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like',
    ];

}