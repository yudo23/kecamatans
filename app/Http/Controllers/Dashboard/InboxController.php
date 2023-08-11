<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\InboxService;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    protected $route;
    protected $view;
    protected $inboxService;

    public function __construct()
    {
        $this->route = "dashboard.inboxs.";
        $this->view = "dashboard.inboxs.";
        $this->inboxService = new InboxService();
    }

    public function index(Request $request)
    {
        $response = $this->inboxService->index($request);

        $data = [
            'table' => $response->data,
        ];

        return view($this->view . 'index', $data);
    }

    public function show($id)
    {
        $result = $this->inboxService->show($id);
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

}
