<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IndonesiaService;
use Log;

class DistrictController extends Controller
{
    protected $route;
    protected $view;
    protected $indonesiaService;

    public function __construct()
    {
        $this->route = "dashboard.indonesia.districts.";
        $this->view = "dashboard.indonesia.districts.";
        $this->indonesiaService = new IndonesiaService();
    }

    public function index(Request $request)
    {
        $response = $this->indonesiaService->district($request);

        $data = [
            'table' => $response->data,
        ];

        return view($this->view . 'index', $data);
    }
}
