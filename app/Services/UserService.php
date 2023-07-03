<?php

namespace App\Services;

use App\Models\User;
use App\Models\Endereco;
use Illuminate\Support\Facades\Hash;


class UserService {

    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function update($request, $id)
    {
      $user = User::findOrFail($id);
      if($user){
        $user->update([
            'nome' => $request->nome,
            'nome_loja' => $request->nome_loja,
            'email' => $request->email,
            'cnpj_cpf' => $request->cnpj_cpf,
            'telefone' => $request->telefone,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf
        ]);
        return $user;
      }
      return false;
    }

    public function delete($id): void
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}