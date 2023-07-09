<?php

namespace App\Filter\v1\Color;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class ColorQuery extends Filter {

    protected $safeParms = [
        'cor' => ['eq', 'ne', 'lk'],
        'hexdecimal' => ['eq', 'ne', 'lk'],
    ];
    
    protected $columnMap = [
        'cor' => 'cor',
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like'
    ];

}