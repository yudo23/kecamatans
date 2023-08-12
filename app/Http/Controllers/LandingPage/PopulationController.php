<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PopulationService;
use App\Traits\HasSeo;

class PopulationController extends Controller
{
    use HasSeo;

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

        $this->seo(
            title: "Jumlah Penduduk",
        );

        $data = [
            'table' => $table,
        ];

        return view($this->view."index",$data);
    }
}
