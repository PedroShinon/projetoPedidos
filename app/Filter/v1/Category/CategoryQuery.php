<?php

namespace App\Filter\v1\Category;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class CategoryQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'in', 'lk'],
        'descricao' => ['eq', 'ne', 'lk'],
        'image' => ['eq', 'ne', 'lk'],
        'status' => ['eq', 'ne', 'lk'], 
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