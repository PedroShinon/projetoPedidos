<?php

namespace App\Http\Controllers\Api\v1\Marca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MarcaService;
use App\Http\Resources\Api\v1\Marca\MarcaResource;
use App\Http\Requests\Api\v1\Marca\MarcaCreateRequest;
use App\Http\Requests\Api\v1\Marca\MarcaUpdateRequest;

class MarcaController extends Controller
{

    private $marcaService;

    public function __construct(protected MarcaService $service)
    {
        $this->marcaService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $marcas = $this->marcaService->getAll($request);
        return MarcaResource::make(['message' => 'Marcas coletadas','data' => $marcas])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaCreateRequest $request)
    {
        if(!$marca = $this->marcaService->create($request))
        {
            return MarcaResource::make(['message' => 'não foi possivel criar'])->response()->setStatusCode(403);
        }
        return MarcaResource::make(['message' => 'marca criada', 'data' => $marca])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$marca = $this->marcaService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return MarcaResource::make(['message' => 'Marca coletado','data' => $marca])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaUpdateRequest $request, string $id)
    {
        $request->validated();
        if($marca = $this->marcaService->update($request, $id)){
            return MarcaResource::make(['message' => 'Marca atualizada', 'data' => $marca])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->marcaService->getById($id)){
            $this->marcaService->delete($id);
             return response()->json(['message' => 'Marca deletada'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
