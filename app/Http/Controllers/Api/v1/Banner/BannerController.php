<?php

namespace App\Http\Controllers\Api\v1\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Resources\Api\v1\Banner\BannerResource;
use App\Http\Requests\Api\v1\Banner\BannerCreateRequest;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(protected BannerService $service)
    {
        $this->bannerService = $service;

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only(['store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banners = $this->bannerService->getAll($request);
        return BannerResource::make(['message' => 'Banners coletadas','data' => $banners])->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerCreateRequest $request)
    {
        if(!$banner = $this->bannerService->create($request))
        {
            return BannerResource::make(['message' => 'não foi possivel criar o banner'])->response()->setStatusCode(403);
        }
        return BannerResource::make(['message' => 'banner criado', 'data' => $banner])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$banner = $this->bannerService->getById($id)){
            return response()->json(['message' => 'Nenhum dado encontrado'], 404);  
         }
         return BannerResource::make(['message' => 'banner coletado','data' => $banner])->response()->setStatusCode(200); 
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
        if($this->bannerService->getById($id)){
            $this->bannerService->deleteBanner($id);
             return response()->json(['message' => 'banner deletado'], 204);
         }
         return response()->json(['message' => 'dado não foi encontrado'], 404); 
    }
}
