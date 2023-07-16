<?php

namespace App\Filter\v1\AttributeValue;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class AttributeValueQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'in', 'lk'],
        'attribute_id' => ['eq', 'ne', 'in', 'lk']
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