<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Resources\Api\v1\Product\ProductResource;
use App\Http\Requests\Api\v1\Product\ProductCreateRequest;
use App\Http\Requests\Api\v1\Product\ProductUpdateRequest;

class ProductController extends Controller
{

    private $productService;

    public function __construct(protected ProductService $service)
    {
        $this->productService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productService->getAll($request);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        if(!$product = $this->productService->create($request))
        {
            return response()->json(['message' => 'não foi possivel criar', 'status' => 403]);
        }
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$product = $this->productService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado', 'status' => 404]);  
         }
         return ProductResource::make($product); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $request->validated();
        if($product = $this->productService->update($request, $id)){
            return ProductResource::make($product); 
        }
        return response()->json(['message' => 'dado não foi encontrado', 'status' => 404]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->productService->getById($id)){
            $this->productService->delete($id);
             return response()->json(['message' => 'Produto deletado', 'status' => 204]);
         }
         return response()->json(['message' => 'dado não foi encontrado', 'status' => 404]); 
    }
}
