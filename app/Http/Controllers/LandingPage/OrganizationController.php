<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings\LandingPageSetting;

class OrganizationController extends Controller
{
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

        return view($this->view."index",$data);
    }
}
