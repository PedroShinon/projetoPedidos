<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\Api\v1\User\UserUpdateRequest;
use App\Http\Requests\Api\v1\User\UserCreateRequest;
use App\Http\Resources\Api\v1\User\UserResource;
use App\Models\User;

use App\Filter\v1\User\UserQuery;

class UserController extends Controller
{
    private $userService;

    public function __construct(protected UserService $service)
    {
        $this->userService = $service;

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userService->getAll($request);
        return UserResource::make(['message' => 'Usuarios coletados','data' => $users])->response()->setStatusCode(200);
    }

    public function usersRegisteredsThisMonth()
    {
        $users = $this->userService->usersRegisteredsThisMonth($request);
        return UserResource::make(['message' => 'Usuarios coletados','data' => $users])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        if(!$user = $this->userService->create($request))
        {
            return UserResource::make(['message' => 'não foi possivel criar'])->response()->setStatusCode(403);
        }
        return UserResource::make(['message' => 'usuario criado', 'data' => $user])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        
        if(!$user = $this->userService->getById($id)){
           return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
        }
        return UserResource::make(['message' => 'Usuarios coletado','data' => $user])->response()->setStatusCode(200); 
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $request->validated();
        if($user = $this->userService->update($request, $id)){
            return UserResource::make(['message' => 'Usuarios atualizado', 'data' => $user])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        if($this->userService->getById($id)){
           $this->userService->delete($id);
            return response()->json(['message' => 'Usuário deletado'], 204);
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
