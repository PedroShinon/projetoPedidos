<?php

namespace App\Http\Controllers\Api\v1\Color;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ColorService;
use App\Http\Resources\Api\v1\Color\ColorResource;
use App\Http\Requests\Api\v1\Color\ColorCreateRequest;
use App\Http\Requests\Api\v1\Color\ColorUpdateRequest;

class ColorController extends Controller
{

    private $colorService;

    public function __construct(protected ColorService $service)
    {
        $this->colorService = $service;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $colors = $this->colorService->getAll($request);
        return ColorResource::make(['message' => 'cores coletadas', 'status' => 200, 'data' => $colors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorCreateRequest $request)
    {
        if(!$color = $this->colorService->create($request))
        {
            return ColorResource::make(['message' => 'não foi possivel criar'])->response()->setStatusCode(403);
        }
        return ColorResource::make(['message' => 'cor criada', 'data' => $color])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$color = $this->colorService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return ColorResource::make(['message' => 'Categoria coletado','data' => $color])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorUpdateRequest $request, string $id)
    {
        $request->validated();
        if($color = $this->colorService->update($request, $id)){
            return ColorResource::make(['message' => 'Cor atualizada', 'data' => $color])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->colorService->getById($id)){
            $this->colorService->delete($id);
             return response()->json(['message' => 'Cor deletada'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
