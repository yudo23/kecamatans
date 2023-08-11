<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InformationService;

class InformationController extends Controller
{
    protected $route;
    protected $view;
    protected $informationService;

    public function __construct()
    {
        $this->route = "landing-page.informations.";
        $this->view = "landing-page.informations.";
        $this->informationService = new InformationService();
    }

    public function index(Request $request){
        $table = $this->informationService->index($request);
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
        $result = $this->informationService->showBySlug($slug);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result,
        ];

        return view($this->view."show",$data);
    }
}
