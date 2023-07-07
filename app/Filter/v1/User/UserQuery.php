<?php

namespace App\Filter\v1\User;

use Illuminate\Http\Request;
use App\Filter\v1\Filter;


class UserQuery extends Filter {

    protected $safeParms = [
        'nome' => ['eq', 'ne', 'in', 'lk'],
        'nome_loja' => ['eq', 'ne', 'lk'],
        'email' => ['eq', 'ne', 'lk'],
        'cnpj_cpf' => ['eq', 'ne', 'lk'], 
        'telefone' => ['eq', 'ne', 'lk'],
        'logradouro' => ['eq', 'ne', 'lk'],
        'bairro' => ['eq', 'ne', 'lk'],
        'cidade' => ['eq', 'ne', 'lk'],
        'uf' => ['eq', 'ne', 'lk'],
        'permissao' => ['eq', 'ne'],
        'fiado' => ['eq', 'ne'],
    ];
    
    protected $columnMap = [
        'nomeLoja' => 'nome_loja',
        'cnpjCpf' => 'cnpj_cpf'
    ];

    protected  $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'in' => 'in',
        'lk' => 'like'
    ];

}