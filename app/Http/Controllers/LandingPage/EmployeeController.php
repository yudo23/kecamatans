<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $route;
    protected $view;
    protected $employeeService;

    public function __construct()
    {
        $this->route = "landing-page.employees.";
        $this->view = "landing-page.employees.";
        $this->employeeService = new EmployeeService();
    }

    public function index(Request $request){
        $table = $this->employeeService->index($request,false);
        if (!$table->success) {
            alert()->error('Gagal', $table->message);
            return redirect()->route('landing-page.home.index')->withInput();
        }
        $table = $table->data;

        $data = [
            'table' => $table
        ];

        return view($this->view."index",$data);
    }
}
