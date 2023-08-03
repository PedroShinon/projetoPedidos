<?php

namespace App\Http\Controllers\Api\v1\ProductImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductImageService;
use App\Http\Resources\Api\v1\ProductImage\ProductImageResource;
use App\Http\Requests\Api\v1\ProductImage\ProductImageCreateRequest;
use App\Http\Requests\Api\v1\ProductImage\ProductImageUpdateRequest;

class ProductImageController extends Controller
{

    private $productImageService;

    public function __construct(protected ProductImageService $service)
    {
        $this->productImageService = $service;

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only(['store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productImage = $this->productImageService->getAll($request);
        return ProductImageResource::make(['message' => 'Imagens de produtos coletadas','data' => $productImage])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImageCreateRequest $request)
    {
        if(!$productImage = $this->productImageService->create($request))
        {
            return ProductImageResource::make(['message' => 'não foi possivel criar imagem do produto'])->response()->setStatusCode(403);
        }
        return ProductImageResource::make(['message' => 'imagem do produto criada', 'data' => $productImage])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$productImage = $this->productImageService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return ProductImageResource::make(['message' => 'Imagem de produto coletado','data' => $productImage])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, string $id)
    //{
        //
    //}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->productImageService->getById($id)){
            $this->productImageService->deleteImage($id);
             return response()->json(['message' => 'Imagem do produto deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
