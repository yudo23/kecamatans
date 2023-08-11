<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Auth;

class DashboardController extends Controller
{
    protected $route;
    protected $view;
    protected $loginService;

    public function __construct()
    {
        $this->route = "dashboard.index";
        $this->view = "dashboard.dashboard";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->view);
    }
}
