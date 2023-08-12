<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings\LandingPageSetting;
use App\Traits\HasSeo;

class OrganizationController extends Controller
{
    use HasSeo;

    protected $route;
    protected $view;

    public function __construct()
    {
        $this->route = "landing-page.organizations.";
        $this->view = "landing-page.organizations.";
    }

    public function index(LandingPageSetting $landingPageSetting){
        $data = [
            'result' => $landingPageSetting
        ];

        $this->seo(
            title: "Organisasi",
        );

        return view($this->view."index",$data);
    }
}
