<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceService;

class ServiceController extends Controller
{
    protected $route;
    protected $view;
    protected $serviceService;

    public function __construct()
    {
        $this->route = "landing-page.services.";
        $this->view = "landing-page.services.";
        $this->serviceService = new ServiceService();
    }

    public function index(Request $request){
        $table = $this->serviceService->index($request);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $data = [
            'table' => $table,
        ];

        return view($this->view."index",$data);
    }

    public function show($slug){
        $result = $this->serviceService->showBySlug($slug);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result
        ];

        return view($this->view."show",$data);
    }
}
