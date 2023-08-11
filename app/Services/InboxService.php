<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\LandingPage\Contact\TicketRequest;
use App\Mail\TicketMail;
use App\Models\Inbox;
use App\Settings\LandingPageSetting;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;
use Mail;

class InboxService extends BaseService
{
    protected $inbox;

    public function __construct()
    {
        $this->inbox = new Inbox();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

        $table = $this->inbox;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
                $query2->orWhere('email', 'like', '%' . $search . '%');
                $query2->orWhere('subject', 'like', '%' . $search . '%');
                $query2->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        $table = $table->orderBy('created_at', 'DESC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        return $this->response(true, 'Berhasil mendapatkan data', $table);
    }

    public function show($id)
    {
        try {
            $result = $this->inbox;
            $result = $result->where('id',$id);
            $result = $result->first();

            if(!$result){
                return $this->response(false, "Data tidak ditemukan");
            }

            return $this->response(true, 'Berhasil mendapatkan data', $result);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function store(TicketRequest $request,LandingPageSetting $landingPageSetting)
    {
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $email = (empty($request->email)) ? null : trim(strip_tags($request->email));
            $message = (empty($request->message)) ? null : trim(strip_tags($request->message));
            $subject = (empty($request->subject)) ? null : trim(strip_tags($request->subject));
            $adminEmail = $landingPageSetting->email;

            $create = $this->inbox->create([
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'subject' => $subject,
            ]);

            if($adminEmail){
                Mail::to($adminEmail)->send(new TicketMail($email, $message, $name,$subject));
            }

            return $this->response(true, 'Berhasil menambahkan data',$create);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
