<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\BlogEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Services\BlogCategoryService;

class BlogController extends Controller
{
    protected $route;
    protected $view;
    protected $blogService;
    protected $blogCategoryService;

    public function __construct()
    {
        $this->route = "landing-page.blogs.";
        $this->view = "landing-page.blogs.";
        $this->blogService = new BlogService();
        $this->blogCategoryService = new BlogCategoryService();
    }

    public function index(Request $request){
        $request->merge(["status" => BlogEnum::STATUS_TRUE]);
        $table = $this->blogService->index($request);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $categories = $this->blogCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'table' => $table,
            'categories' => $categories,
        ];

        return view($this->view."index",$data);
    }

    public function show($slug){
        $result = $this->blogService->showBySlug($slug);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $result = $result->data;

        $blogs = $this->blogService->index(new Request([]),false);
        $blogs = $blogs->data;

        $categories = $this->blogCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'result' => $result,
            'blogs' => $blogs,
            'categories' => $categories,
        ];

        return view($this->view."show",$data);
    }

    public function categories(Request $request,$slug){
        $table = $this->blogService->getBlogByCategorySlug($request,$slug);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $categories = $this->blogCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'table' => $table,
            'categories' => $categories,
        ];

        return view($this->view."index",$data);
    }
}
