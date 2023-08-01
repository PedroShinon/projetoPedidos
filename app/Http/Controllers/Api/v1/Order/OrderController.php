<?php

namespace App\Http\Controllers\Api\v1\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Resources\Api\v1\Order\OrderResource;
use App\Http\Requests\Api\v1\Order\OrderCreateRequest;
use App\Http\Requests\Api\v1\Order\OrderUpdateRequest;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(protected OrderService $service)
    {
        $this->orderService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->getAll($request);
        if (!$orders) {
            return response()->json(['message' => 'não foi encontrado pedidos'], 404);
        }
        return OrderResource::collection($orders)->response()->setStatusCode(200);
    }

    //pega ordens pertecentes ao usuário solicitante
    public function getOrdersLinkedToUser(Request $request)
    {
        $orders = $this->orderService->getOrdersLinkedToUser($request);
        return OrderResource::collection($orders)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreateRequest $request)
    {
        
        if(!$order = $this->orderService->create($request))
        {

            return response()->json(['message' => 'não foi possivel criar o pedido'], 403);

        } 
        //if (isset($order['message'])) {
        //    return response()->json(['message' => $order['message']], 403);
        //}
        return response()->json($order, 200);
        //return OrderResource::make($order)->response()->setStatusCode(201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$order = $this->orderService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return OrderResource::make($order)->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, string $id)
    {
        $request->validated();
        if($order = $this->orderService->update($request, $id)){
            return OrderResource::make($order)->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    public function StatusUpdateByUser(string $id)
    {
        $request->validated();
        if($order = $this->orderService->StatusUpdateByUser($id)){
            return OrderResource::make($order)->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->orderService->getById($id)){
            $this->orderService->delete($id);
             return response()->json(['message' => 'Pedido deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
