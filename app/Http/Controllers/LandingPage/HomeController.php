<?php

namespace App\Http\Controllers\LandingPage;

use App\Helpers\SettingHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SliderService;
use App\Services\ServiceService;
use App\Services\BlogService;
use App\Services\GalleryService;
use App\Services\AnnouncementService;
use App\Settings\LandingPageSetting;
use App\Traits\HasSeo;

class HomeController extends Controller
{
    use HasSeo;

    protected $route;
    protected $view;
    protected $sliderService;
    protected $serviceService;
    protected $blogService;
    protected $galleryService;
    protected $announcementService;

    public function __construct()
    {
        $this->route = "landing-page.home.";
        $this->view = "landing-page.home.";
        $this->sliderService = new SliderService();
        $this->serviceService = new ServiceService();
        $this->blogService = new BlogService();
        $this->galleryService = new GalleryService();
        $this->announcementService = new AnnouncementService();
    }

    public function index(LandingPageSetting $landingPageSetting){
        $sliders = $this->sliderService->index(new Request([]),false);
        $sliders = $sliders->data;

        $services = $this->serviceService->index(new Request([]),false);
        $services = $services->data;

        $blogs = $this->blogService->index(new Request([]),false);
        $blogs = $blogs->data->take(6);

        $galleries = $this->galleryService->index(new Request([]),false);
        $galleries = $galleries->data;

        $announcements = $this->announcementService->index(new Request([]),false);
        $announcements = $announcements->data->take(6);

        $this->seo(
            title: SettingHelper::settings("landing_page", "title"),
            description: SettingHelper::settings("landing_page", "description"),
            keywords: SettingHelper::settings("landing_page", "keyword"),
            url: null,
            image: SettingHelper::settings("landing_page", "logo")
        );

        $data = [
            'sliders' => $sliders,
            'services' => $services,
            'galleries' => $galleries,
            'blogs' => $blogs,
            'announcements' => $announcements,
            'settings' => $landingPageSetting
        ];

        return view($this->view."index",$data);
    }
}
