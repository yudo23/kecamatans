<?php

namespace App\Http\Controllers\LandingPage;

use App\Enums\AnnouncementEnum;
use App\Helpers\SettingHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AnnouncementService;
use App\Traits\HasSeo;

class AnnouncementController extends Controller
{
    use HasSeo;

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

        $this->seo(
            title: "Pengumuman",
        );

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

        $this->seo(
            title: $result->title,
            description: $result->trixRender("content"),
            keywords: $result->title,
            url: route("landing-page.announcements.show",$result->slug),
            image: asset($result->image),
        );

        $data = [
            'result' => $result,
        ];

        return view($this->view."show",$data);
    }
}
