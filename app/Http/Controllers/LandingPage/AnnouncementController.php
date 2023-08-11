<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\AnnouncementEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AnnouncementService;

class AnnouncementController extends Controller
{
    protected $route;
    protected $view;
    protected $announcementService;

    public function __construct()
    {
        $this->route = "landing-page.announcements.";
        $this->view = "landing-page.announcements.";
        $this->announcementService = new AnnouncementService();
    }

    public function index(Request $request){
        $request->merge(["status" => AnnouncementEnum::STATUS_TRUE]);
        $table = $this->announcementService->index($request);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $data = [
            'table' => $table,
        ];

        return view($this->view."index",$data);
    }

    public function show($slug){
        $result = $this->announcementService->showBySlug($slug);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result,
        ];

        return view($this->view."show",$data);
    }
}
