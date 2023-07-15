<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v1\Auth\UserRegisterRequest;
use App\Http\Requests\Api\v1\Auth\AdminRegisterRequest;
use App\Http\Requests\Api\v1\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;


class AuthController extends Controller
{

    private $authService;

    public function __construct(protected AuthService $service)
    {
        $this->authService = $service;
    }

    public function login(UserLoginRequest $request)
    {
        $request->validated();
        $user = $this->authService->login($request);
        return response()->json($user,$user['status']); 
    }

    public function register(UserRegisterRequest $request)
    {
        $request->validated();
        $user = $this->authService->register($request);
        return response()->json($user,$user['status']);   
    }

    public function logout(Request $request)
    {
        $user = $this->authService->logout($request);
        return response()->json($user, $user['status']); 
    }

    public function changePermission(Request $request)
    {
        $user = $this->authService->changePermission($request);
        return response()->json($user, $user['status']);
    }

 



}
