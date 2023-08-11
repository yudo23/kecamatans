<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PotentialService;
use App\Services\PotentialCategoryService;

class PotentialController extends Controller
{
    protected $route;
    protected $view;
    protected $potentialService;
    protected $potentialCategoryService;

    public function __construct()
    {
        $this->route = "landing-page.potentials.";
        $this->view = "landing-page.potentials.";
        $this->potentialService = new PotentialService();
        $this->potentialCategoryService = new PotentialCategoryService();
    }

    public function index(Request $request){
        $table = $this->potentialService->index($request,false);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $categories = $this->potentialCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'table' => $table,
            'categories' => $categories,
        ];

        return view($this->view."index",$data);
    }

    public function show($slug){
        $result = $this->potentialService->showBySlug($slug);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $result = $result->data;

        $categories = $this->potentialCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $potentials = $this->potentialService->index(new Request([]),false);
        $potentials = $potentials->data->take(5);

        $data = [
            'result' => $result,
            'categories' => $categories,
            'potentials' => $potentials,
        ];

        return view($this->view."show",$data);
    }

    public function categories(Request $request,$slug){
        $table = $this->potentialService->getBlogByCategorySlug($request,$slug);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $categories = $this->potentialCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'table' => $table,
            'categories' => $categories,
        ];

        return view($this->view."index",$data);
    }
}
