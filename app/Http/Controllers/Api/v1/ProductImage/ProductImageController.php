<?php

namespace App\Http\Controllers\Api\v1\ProductImage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductImageService;

class ProductImageController extends Controller
{

    private $productImageService;

    public function __construct(protected ProductImageService $service)
    {
        $this->productImageService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

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
