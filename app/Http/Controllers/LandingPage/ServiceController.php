<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceService;
use App\Traits\HasSeo;

class ServiceController extends Controller
{
    use HasSeo;

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

        $this->seo(
            title: "Layanan Kami",
        );

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

        $this->seo(
            title: $result->name,
            description: $result->trixRender("content"),
            keywords: $result->name,
            url: route("landing-page.services.show",$result->slug),
            image: null,
        );

        $data = [
            'result' => $result
        ];

        return view($this->view."show",$data);
    }
}
