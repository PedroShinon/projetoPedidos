<?php

namespace App\Filter\v1\Marca;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class MarcaQuery extends Filter {

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