<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IndonesiaService;
use Log;

class CityController extends Controller
{
    protected $route;
    protected $view;
    protected $indonesiaService;

    public function __construct()
    {
        $this->route = "dashboard.indonesia.cities.";
        $this->view = "dashboard.indonesia.cities.";
        $this->indonesiaService = new IndonesiaService();
    }

    public function index(Request $request)
    {
        $response = $this->indonesiaService->city($request);

        $data = [
            'table' => $response->data,
        ];

        return view($this->view . 'index', $data);
    }
}
