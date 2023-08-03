<?php

namespace App\Http\Controllers\Api\v1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{

    private $dashboardService;

    public function __construct(protected DashboardService $service)
    {
        $this->dashboardService = $service;

        $this->middleware(['auth:sanctum', 'ability:admin_privilege'])->only(['dashboard']);
    }



    public function dashboard(Request $request)
    {
        
        if(!$data = $this->dashboardService->getData($request))
        {
            return response()->json(['message' => 'não foi possivel resgatar informacoes'], 404);
        }
        
        return response()->json(['message' => 'dados resgatados', 'data' => $data], 200);
    }

    public function dashboardAllData(Request $request)
    {
        
        if(!$data = $this->dashboardService->getAllData($request))
        {
            return response()->json(['message' => 'não foi possivel resgatar informacoes'], 404);
        }
        
        return response()->json(['message' => 'dados resgatados', 'data' => $data], 200);
    }
}
