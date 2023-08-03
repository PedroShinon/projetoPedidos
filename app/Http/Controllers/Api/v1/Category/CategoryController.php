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

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only(['store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorys = $this->categoryService->getAll($request);
        return CategoryResource::make(['message' => 'categorias coletadas','data' => $categorys])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        if(!$category = $this->categoryService->create($request))
        {
            return CategoryResource::make(['message' => 'não foi possivel criar'])->response()->setStatusCode(403);
        }
        return CategoryResource::make(['message' => 'categoria criada', 'data' => $category])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$category = $this->categoryService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return CategoryResource::make(['message' => 'Categoria coletado','data' => $category])->response()->setStatusCode(200); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $request->validated();
        if($category = $this->categoryService->update($request, $id)){
            return CategoryResource::make(['message' => 'Categoria atualizada', 'data' => $category])->response()->setStatusCode(202); 
        }
        return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->categoryService->getById($id)){
            $this->categoryService->delete($id);
             return response()->json(['message' => 'Categoria deletada'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
