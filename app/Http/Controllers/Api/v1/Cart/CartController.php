<?php

namespace App\Http\Controllers\Api\v1\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Resources\Api\v1\Cart\CartResource;
use App\Http\Requests\Api\v1\Cart\CartCreateRequest;
use App\Http\Requests\Api\v1\Cart\CartUpdateRequest;

class CartController extends Controller
{
    private $cartService;

    public function __construct(protected CartService $service)
    {
        $this->cartService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carts = $this->cartService->getAll($request);
        return CartResource::make(['message' => 'Carrinhos coletados','data' => $carts])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartCreateRequest $request)
    {
        if(!$cart = $this->cartService->create($request))
        {
            return CartResource::make(['message' => 'não foi possivel criar o carrinho'])->response()->setStatusCode(403);
        }
        return CartResource::make(['message' => 'Carrinho criado', 'data' => $cart])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$cart = $this->cartService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return CartResource::make(['message' => 'Carrinho coletado','data' => $cart])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartUpdateRequest $request, string $id)
    {
        $request->validated();
        if($cart = $this->cartService->update($request, $id)){
            return CartResource::make(['message' => 'Item do carrinho atualizado', 'data' => $cart])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->cartService->getById($id)){
            $this->cartService->delete($id);
             return response()->json(['message' => 'carrinho deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    public function getCartsLinkedToUser(Request $request)
    {
        $carts = $this->cartService->getCartsLinkedToUser($request);
        return CartResource::make(['message' => 'Carrinhos coletados','data' => $carts])->response()->setStatusCode(200);
    }
}
