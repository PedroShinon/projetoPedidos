<?php

namespace App\Http\Controllers\Api\v1\Attribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AttributeService;
use App\Http\Resources\Api\v1\Attribute\AttributeResource;
use App\Http\Requests\Api\v1\Attribute\AttributeCreateRequest;
use App\Http\Requests\Api\v1\Attribute\AttributeUpdateRequest;

class AttributeController extends Controller
{

    private $attributeService;

    public function __construct(protected AttributeService $service)
    {
        $this->attributeService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attributes = $this->attributeService->getAll($request);
        if (!$attributes) {
            return response()->json(['message' => 'não foi encontrado atributos'], 404);
        }
        return AttributeResource::make(['message' => 'Atributos coletados','data' => $attributes])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeCreateRequest $request)
    {
        if(!$attribute = $this->attributeService->create($request))
        {
            return AttributeResource::make(['message' => 'não foi possivel criar'])->response()->setStatusCode(403);
        }
        return AttributeResource::make(['message' => 'atributo criado', 'data' => $attribute])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$attribute = $this->attributeService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return AttributeResource::make(['message' => 'Atributo coletado','data' => $attribute])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeUpdateRequest $request, string $id)
    {
        $request->validated();
        if($attribute = $this->attributeService->update($request, $id)){
            return AttributeResource::make(['message' => 'Atributo atualizado', 'data' => $attribute])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->attributeService->getById($id)){
            $this->attributeService->delete($id);
             return response()->json(['message' => 'Atributo deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
