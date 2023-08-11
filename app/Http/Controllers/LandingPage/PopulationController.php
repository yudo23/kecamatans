<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PopulationService;

class PopulationController extends Controller
{
    protected $route;
    protected $view;
    protected $populationService;

    public function __construct()
    {
        $this->route = "landing-page.populations.";
        $this->view = "landing-page.populations.";
        $this->populationService = new PopulationService();
    }

    public function index(Request $request){
        $table = $this->populationService->index($request,false);
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
}
