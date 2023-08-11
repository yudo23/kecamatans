<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    protected $route;
    protected $view;
    protected $galleryService;

    public function __construct()
    {
        $this->route = "landing-page.galleries.";
        $this->view = "landing-page.galleries.";
        $this->galleryService = new GalleryService();
    }

    public function index(Request $request){
        $table = $this->galleryService->index($request,false);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $data = [
            'table' => $table
        ];

        return view($this->view."index",$data);
    }
}
