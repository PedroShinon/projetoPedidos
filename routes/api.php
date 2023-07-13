<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\User\UserController;
use App\Http\Controllers\Api\v1\Category\CategoryController;
use App\Http\Controllers\Api\v1\Color\ColorController;
use App\Http\Controllers\Api\v1\Product\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function(){
    Route::post('/login',[AuthController::class, 'login']);
    Route::post('/register',[AuthController::class, 'register']);

    //middleware (userAccess)
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::post('/logout',[AuthController::class, 'logout']);
        
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/categorys', CategoryController::class);
        Route::apiResource('/colors', ColorController::class);
        Route::apiResource('/products', ProductController::class);

        //super-admin(super_privilege)Provider
        Route::middleware(['can:assist_privilege'])->group(function(){
            
                    
        });

        //super-admin(super_privilege)Provider
        Route::post('/admin/changePermission',[AuthController::class, 'changePermission']);
        


    });

});


