<?php

namespace App\Services;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function register($request)
    {
        $typeUser = $request->tipo_usuario;

        $user = User::create([
            'nome' => $request->nome,
            'nome_loja' => $request->nome_loja,
            'cnpj_cpf' => $request->cnpj_cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'tipo_usuario' => $request->tipo_usuario,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => strtoupper($request->uf),
            'permissao' => $typeUser == 'admin' ? true : false,
            'fiado' => false
        ]);
           
        return ['message' => 'Usuario criado',
                'status' => 201,
                 'data' => ['user' => $user],
                 'errors' => []
                ];
    }

    public function login($request)
    {
        $user = User::where('cnpj_cpf', $request->cnpj_cpf)->first();
        if ($user && $user->permissao == true) {
            $user->tokens()->delete();

            if($user->tipo_usuario == 'user'){
                $token = $user->createToken('userAccess', ['user_privilege']);
            } elseif ($user->tipo_usuario == 'assist') {
                $token = $user->createToken('assistAccess', ['assist_privilege']);
            } elseif ($user->tipo_usuario == 'admin'){
                $token = $user->createToken('adminAccess', ['admin_privilege']);
            } else {
                return [ 'message' => 'erro ao adquirir credenciais',
                'status' => 401,
                'data' => [],
                'errors' => []
                ];
            }
            return ['message' => 'Usuario logado',
                    'status' => 202,
                    'data' => ['user' => $user, 'token' => $token],
                    'errors' => []
                    ];
        } else {
            return ['message' => 'credenciais incorretas, permissão inválida','status' => 401,'data' => [],'errors' => []];
        }

    }

    public function logout($request){
        $request->user()->tokens()->delete();
        return ['message' => 'Usuario deslogado','status' => 200];
    }

    //admin

    public function changePermission($request)
    {
        if ($request->user()->tokenCan('admin_privilege')) {
            if($user = User::where('id', $request->id)->first()){
                if($user->permissao == false){
                    $user->update([
                        'permissao' => 1
                    ]);
                } else {
                    $user->update([
                        'permissao' => 0
                    ]);
                }
                return [ 'message' => 'Permissão alterada',
                'status' => 204
                ];
            
            }else {
                return [ 'message' => 'Não encontrado',
                'status' => 404
                ];
            }
            
        }
            return [ 'message' => 'Sem autorização para realizar ação',
            'status' => 403];
    }


}