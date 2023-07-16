<?php

namespace App\Filter\v1\Attribute;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class AttributeQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'in', 'lk'],
        'code' => ['eq', 'ne', 'lk'], 
    ];
    
    protected $columnMap = [
        'nome' => 'nome',
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like'
    ];

}