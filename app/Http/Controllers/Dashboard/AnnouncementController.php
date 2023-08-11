<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\AnnouncementEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Announcement\StoreRequest;
use App\Http\Requests\Announcement\UpdateRequest;
use App\Services\AnnouncementService;
use Log;

class AnnouncementController extends Controller
{
    protected $route;
    protected $view;
    protected $annountcementService;

    public function __construct()
    {
        $this->route = "dashboard.announcements.";
        $this->view = "dashboard.announcements.";
        $this->annountcementService = new AnnouncementService();
    }

    public function index(Request $request)
    {
        $response = $this->annountcementService->index($request);

        $status = AnnouncementEnum::status();

        $data = [
            'table' => $response->data,
            'status' => $status,
        ];

        return view($this->view . 'index', $data);
    }

    public function show($id)
    {
        $result = $this->annountcementService->show($id);
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
        $result = $this->annountcementService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $status = AnnouncementEnum::status();

        $data = [
            'result' => $result,
            'status' => $status,
        ];

        return view($this->view . "edit", $data);
    }

    public function create(){

        $status = AnnouncementEnum::status();

        $data = [
            'status' => $status
        ];

        return view($this->view."create",$data);
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->annountcementService->store($request);
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
            $response = $this->annountcementService->update($request, $id);
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
            $response = $this->annountcementService->delete($id);
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
