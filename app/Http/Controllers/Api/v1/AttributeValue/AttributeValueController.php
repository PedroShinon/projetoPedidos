<?php

namespace App\Http\Controllers\Api\v1\AttributeValue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AttributeValueService;
use App\Http\Resources\Api\v1\AttributeValue\AttributeValueResource;
use App\Http\Requests\Api\v1\AttributeValue\AttributeValueCreateRequest;
use App\Http\Requests\Api\v1\AttributeValue\AttributeValueUpdateRequest;

class AttributeValueController extends Controller
{

    private $attributeValueService;

    public function __construct(protected AttributeValueService $service)
    {
        $this->attributeValueService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $attributeValues = $this->attributeValueService->getAll($request);
        return AttributeValueResource::make(['message' => 'valores de atributo coletados','data' => $attributeValues])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeValueCreateRequest $request)
    {
        if(!$attributeValue = $this->attributeValueService->create($request))
        {
            return AttributeValueResource::make(['message' => 'não foi possivel criar'])->response()->setStatusCode(403);
        }
        return AttributeValueResource::make(['message' => 'Valor de atributo criado', 'data' => $attributeValue])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$attributeValue = $this->attributeValueService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return AttributeValueResource::make(['message' => 'valor de atributo coletado','data' => $attributeValue])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeValueUpdateRequest $request, string $id)
    {
        $request->validated();
        if($attributeValue = $this->attributeValueService->update($request, $id)){
            return AttributeValueResource::make(['message' => 'Valor de atributo atualizado', 'data' => $attributeValue])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->attributeValueService->getById($id)){
            $this->attributeValueService->delete($id);
             return response()->json(['message' => 'Valor de atributo deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
