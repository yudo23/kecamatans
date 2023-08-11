<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Potential\StoreRequest;
use App\Http\Requests\Potential\UpdateRequest;
use App\Services\PotentialService;
use App\Services\PotentialCategoryService;
use Log;

class PotentialController extends Controller
{
    protected $route;
    protected $view;
    protected $potentialService;
    protected $potentialCategoryService;

    public function __construct()
    {
        $this->route = "dashboard.potentials.";
        $this->view = "dashboard.potentials.";
        $this->potentialService = new PotentialService();
        $this->potentialCategoryService = new PotentialCategoryService();
    }

    public function index(Request $request)
    {
        $response = $this->potentialService->index($request);

        $categories = $this->potentialCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'table' => $response->data,
            'categories' => $categories,
        ];

        return view($this->view . 'index', $data);
    }

    public function show($id)
    {
        $result = $this->potentialService->show($id);
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
        $result = $this->potentialService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $categories = $this->potentialCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'result' => $result,
            'categories' => $categories,
        ];

        return view($this->view . "edit", $data);
    }

    public function create(){

        $categories = $this->potentialCategoryService->index(new Request([]),false);
        $categories = $categories->data;

        $data = [
            'categories' => $categories
        ];

        return view($this->view."create",$data);
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->potentialService->store($request);
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
            $response = $this->potentialService->update($request, $id);
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
            $response = $this->potentialService->delete($id);
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
