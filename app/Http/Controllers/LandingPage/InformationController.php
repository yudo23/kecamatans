<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InformationService;
use App\Traits\HasSeo;

class InformationController extends Controller
{
    use HasSeo;
    
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

        $this->seo(
            title: "Informasi Desa",
        );

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

        $this->seo(
            title: $result->village->name ?? null,
            description: $result->trixRender("content"),
            keywords: $result->village->name ?? null,
            url: route("landing-page.informations.show",$result->slug),
            image: null,
        );

        $data = [
            'result' => $result,
        ];

        return view($this->view."show",$data);
    }
}
