<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Filter\v1\User\UserQuery;
use Illuminate\Support\Carbon;


class UserService {

    public function getAll($request)
    {
        $filter = new UserQuery();
        $queryItems = $filter->transform($request); //[['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            $users = User::orderBy('created_at', 'desc')->get();
            return $users;
        } else {
            $users = User::orderBy('created_at', 'desc')->where($queryItems)->get();
            return $users;
        }
    }

    public function usersRegisteredsThisMonth(){

        $dataEsteMes = Carbon::now()->month;
        $dataEsteAno = Carbon::now()->format('Y');
        $usersDesseMes = Order::whereMonth('created_at', $dataEsteMes)->orderBy('created_at', 'desc')->whereYear('created_at', $dataEsteAno)->get();
        return $usersDesseMes;

    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function create($request)
    {
        $user = new User;
        $user->nome = $request->nome;
        $user->cnpj_cpf = $request->cnpj_cpf;
        $user->nome_loja = $request->nome_loja;
        $user->email = $request->email;
        $user->telefone = $request->telefone;
        $user->logradouro = $request->logradouro;
        $user->tipo_usuario = $request->tipo_usuario;
        $user->numero = $request->numero;
        $user->bairro = $request->bairro;
        $user->cidade = $request->cidade;
        $user->permissao = $request->permissao;
        $user->uf = strtoupper($request->uf);
        $user->save();

        return $user;

    }

    public function update($request, $id)
    {
      $user = User::find($id);
      if($user){
        $user->update([
            'nome' => $request->nome ?? $user->nome,
            'cnpj_cpf' => $request->cnpj_cpf ?? $user->cnpj_cpf,
            'nome_loja' => $request->nome_loja ?? $user->nome_loja,
            'email' => $request->email ?? $user->email,
            'telefone' => $request->telefone ?? $user->telefone,
            'logradouro' => $request->logradouro ?? $user->logradouro,
            'numero' => $request->numero ?? $user->numero,
            'bairro' => $request->bairro ?? $user->bairro,
            'cidade' => $request->cidade ?? $user->cidade,
            'uf' => $request->uf ?? $user->uf
        ]);
        return $user;
      }
      return false;
    }

    public function delete($id): void
    {
        $user = User::findOrFail($id);
        $user->delete();
        // ENVIAR EMAIL INFORMANDO DO DELETE DA CONTA
    }
}