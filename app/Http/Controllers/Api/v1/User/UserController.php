<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\Api\v1\User\UserUpdateRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct(protected UserService $service)
    {
        $this->userService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($users = $this->userService->getAll()){
            return response()->json(['message' => 'Usuarios coletados', 'status' => 200, 'data' => $users]); 
        }
        return response()->json(['message' => 'nenhum dado encontrado', 'status' => 404]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        if($user = $this->userService->getById($id)){
            return response()->json(['message' => 'Usuario coletado', 'status' => 200, 'data' => $user]); 
        }
        return response()->json(['message' => 'Nenhum dado encontrado', 'status' => 404]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $request->validated();
        $user = $this->userService->update($request, $id);
        if($user){
            return response()->json(['message' => 'Usuario atualizado', 'status' => 200, 'data' => $user]); 
 
        }
        return response()->json(['message' => 'dado não foi encontrado', 'status' => 404]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        if($this->userService->getById($id)){
           $this->userService->delete($id);
            return response()->json(['message' => 'Usuário deletado', 'status' => 204]);
        }
        return response()->json(['message' => 'dado não foi encontrado', 'status' => 404]); 
    }
}
