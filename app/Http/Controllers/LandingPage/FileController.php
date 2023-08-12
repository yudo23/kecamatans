<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Traits\HasSeo;

class FileController extends Controller
{
    use HasSeo;

    protected $route;
    protected $view;
    protected $fileService;

    public function __construct()
    {
        $this->route = "landing-page.files.";
        $this->view = "landing-page.files.";
        $this->fileService = new FileService();
    }

    public function index(Request $request){
        $table = $this->fileService->index($request);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $this->seo(
            title: "Download File",
        );

        $data = [
            'table' => $table
        ];

        return view($this->view."index",$data);
    }
}
