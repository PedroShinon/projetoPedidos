<?php

namespace App\Http\Controllers\Api\v1\ProductAttribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductAttributeService;
use App\Http\Resources\Api\v1\ProductAttribute\ProductAttributeResource;
use App\Http\Requests\Api\v1\ProductAttribute\ProductAttributeCreateRequest;
use App\Http\Requests\Api\v1\ProductAttribute\ProductAttributeUpdateRequest;

class ProductAttributeController extends Controller
{

    private $productAttributeService;

    public function __construct(protected ProductAttributeService $service)
    {
        $this->productAttributeService = $service;

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only(['store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productAttribute = $this->productAttributeService->getAll($request);
        return ProductAttributeResource::make(['message' => 'Atributos de produtos coletadas','data' => $productAttribute])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductAttributeCreateRequest $request)
    {
        if(!$productAttribute = $this->productAttributeService->create($request))
        {
            return ProductAttributeResource::make(['message' => 'não foi possivel criar atributo do produto'])->response()->setStatusCode(400);
        }
        return ProductAttributeResource::make(['message' => 'atributo do produto criado', 'data' => $productAttribute])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$productAttribute = $this->productAttributeService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return ProductAttributeResource::make(['message' => 'Atributo de produto coletado','data' => $productAttribute])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductAttributeUpdateRequest $request, string $id)
    {
        $request->validated();
        if($productAttribute = $this->productAttributeService->update($request, $id)){
            return ProductAttributeResource::make($productAttribute)->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->productAttributeService->getById($id)){
            $this->productAttributeService->deleteAtributo($id);
             return response()->json(['message' => 'Atributo do produto deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
