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

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productService->getAll($request);
        if (!$products) {
            return response()->json(['message' => 'não foi encontrado produtos'], 404);
        }
        return ProductResource::collection($products)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        if(!$product = $this->productService->create($request))
        {
            return response()->json(['message' => 'não foi possivel criar'], 403);
        }
        return ProductResource::make($product)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$product = $this->productService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return ProductResource::make($product)->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $request->validated();
        if($product = $this->productService->update($request, $id)){
            return ProductResource::make($product)->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->productService->getById($id)){
            $this->productService->delete($id);
             return response()->json(['message' => 'Produto deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }


}
