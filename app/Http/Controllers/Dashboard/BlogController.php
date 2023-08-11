<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\BlogEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Services\BlogService;
use App\Services\BlogCategoryService;
use Log;

class BlogController extends Controller
{
    protected $route;
    protected $view;
    protected $blogService;
    protected $blogCategoryService;

    public function __construct()
    {
        $this->route = "dashboard.blogs.";
        $this->view = "dashboard.blogs.";
        $this->blogService = new BlogService();
        $this->blogCategoryService = new BlogCategoryService();
    }

    public function index(Request $request)
    {
        $response = $this->blogService->index($request);

        $categories = $this->blogCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $status = BlogEnum::status();

        $data = [
            'table' => $response->data,
            'categories' => $categories,
            'status' => $status,
        ];

        return view($this->view . 'index', $data);
    }

    public function show($id)
    {
        $result = $this->blogService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result
        ];

        return view($this->view . "show", $data);
    }

    public function edit($id)
    {
        $result = $this->blogService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $categories = $this->blogCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $status = BlogEnum::status();

        $data = [
            'result' => $result,
            'categories' => $categories,
            'status' => $status,
        ];

        return view($this->view . "edit", $data);
    }

    public function create(){

        $categories = $this->blogCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $status = BlogEnum::status();

        $data = [
            'categories' => $categories,
            'status' => $status
        ];

        return view($this->view."create",$data);
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->blogService->store($request);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , $response->data , null, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $response = $this->blogService->update($request, $id);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , $response->data , null, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->blogService->delete($id);
            if (!$response->success) {
                alert()->error('Gagal', $response->message);
                return redirect()->route($this->route . 'index')->withInput();
            }

            alert()->html('Berhasil', $response->message, 'success');
            return redirect()->route($this->route . 'index');
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            alert()->error('Gagal', $th->getMessage());
            return redirect()->route($this->route . 'index')->withInput();
        }
    }
}
