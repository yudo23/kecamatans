<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\LandingPage\Contact\TicketRequest;
use App\Mail\TicketMail;
use App\Services\InboxService;
use App\Settings\LandingPageSetting;
use App\Traits\HasSeo;
use Mail;
use Log;

class ContactUsController extends Controller
{
    use HasSeo;

    protected $route;
    protected $view;
    protected $inboxService;

    public function __construct()
    {
        $this->route = "landing-page.contact-us.";
        $this->view = "landing-page.contact-us.";
        $this->inboxService = new InboxService();
    }

    public function index(){

        $this->seo(
            title: "Hubungi Kami",
        );

        return view($this->view."index");
    }

    public function store(TicketRequest $request,LandingPageSetting $landingPageSetting)
    {
        try {
            $result = $this->inboxService->store($request,$landingPageSetting);
            if (!$result->success) {
                alert()->error('Gagal', $result->message);
                return redirect()->route($this->route . 'index')->withInput();
            }

            alert()->html('Berhasil','Ticket berhasil dikirimkan','success'); 
            return redirect()->route($this->route."index");

        } catch (\Throwable $e) {
            Log::emergency($e->getMessage());
            alert()->html("Gagal",$e->getMessage(), 'error');
            return redirect()->route($this->route."index")->with("error",$e->getMessage())->withInput();
        }
    }
}
