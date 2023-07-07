<?php

namespace App\Http\Controllers\Api\v1\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Resources\Api\v1\Category\CategoryResource;
use App\Http\Requests\Api\v1\Category\CategoryCreateRequest;
use App\Http\Requests\Api\v1\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(protected CategoryService $service)
    {
        $this->categoryService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorys = $this->categoryService->getAll($request);
        return CategoryResource::make(['message' => 'categorias coletadas', 'status' => 200, 'data' => $categorys]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        if(!$category = $this->categoryService->create($request))
        {
            return CategoryResource::make(['message' => 'não foi possivel criar', 'status' => 403]);
        }
        return CategoryResource::make(['message' => 'categoria criada', 'status' => 200, 'data' => $category]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$category = $this->categoryService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado', 'status' => 404]);  
         }
         return CategoryResource::make(['message' => 'Categoria coletado', 'status' => 200, 'data' => $category]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $request->validated();
        if($category = $this->categoryService->update($request, $id)){
            return CategoryResource::make(['message' => 'Categoria atualizada', 'status' => 200, 'data' => $category]); 
        }
        return response()->json(['message' => 'dado não foi encontrado', 'status' => 404]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->categoryService->getById($id)){
            $this->categoryService->delete($id);
             return response()->json(['message' => 'Categoria deletada', 'status' => 204]);
         }
         return response()->json(['message' => 'dado não foi encontrado', 'status' => 404]); 
    }
}
