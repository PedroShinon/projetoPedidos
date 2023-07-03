<?php

namespace App\Services;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function register($request)
    {
<<<<<<< HEAD
        $typeUser = 'admin';
=======
>>>>>>> 16fd2eb3d47665236a9daea1fe08d625299020ae
        $user = User::create([
            'nome' => $request->nome,
            'nome_loja' => $request->nome_loja,
            'cnpj_cpf' => $request->cnpj_cpf,
            'telefone' => $request->telefone,
            'email' => $request->email,
<<<<<<< HEAD
            'tipo_usuario' => $typeUser,
=======
            'tipo_usuario' => 'user',
>>>>>>> 16fd2eb3d47665236a9daea1fe08d625299020ae
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
<<<<<<< HEAD
            'uf' => strtoupper($request->uf),
            'permissao' => $typeUser == 'user' ? true : false
=======
            'uf' => strtoupper($request->uf)
>>>>>>> 16fd2eb3d47665236a9daea1fe08d625299020ae
        ]);
           
        $token = $user->createToken('userAccess', ['user_privilege']);
        return ['message' => 'Usuario criado',
                 'status' => 200 ,
                 'data' => ['user' => $user, 'token' => $token],
                 'errors' => []
                ];
    }

    public function login($request)
    {
        $user = User::where('cnpj_cpf', $request->cnpj_cpf)->firstOrFail();
        if ($user) {
            $user->tokens()->delete();

            if($user->tipo_usuario == 'user'){
                $token = $user->createToken('userAccess', ['user_privilege']);
            } elseif ($user->role == 'admin') {
                $token = $user->createToken('adminAccess', ['admin_privilege']);
            } elseif ($user->role == 'super'){
                $token = $user->createToken('superAccess', ['super_privilege']);
            } else {
                return [ 'message' => 'erro ao adquirir credenciais',
                'status' => 403,
                'data' => [],
                'errors' => []
                ];
            }
            return ['message' => 'Usuario logado',
                    'status' => 200,
                    'data' => ['user' => $user, 'token' => $token],
                    'errors' => []
                    ];
        } else {

            return ['message' => 'credenciais incorretas','status' => 403,'data' => [],'errors' => []];
        }

    }

    public function logout($request){
        $request->user()->tokens()->delete();
        return ['message' => 'Usuario deslogado','status' => 200];
    }

    //admin
    public function adminRegister($request)
    {
        if ($request->user()->tokenCan('super_privilege')) {
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'role' => 1,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('adminAccess', ['admin_privilege']);
            return [ 'message' => 'Usuario criado',
                    'status' => 200 ,
                    'data' => ['user' => $user, 'token' => $token],
                    'errors' => []
                    ];
        }
            return [ 'message' => 'Sem autorização',
            'status' => 403,
            'data' => [],
            'errors' => []
            ];
    }


}