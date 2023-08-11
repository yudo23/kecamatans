<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\User;
use App\Helpers\UploadHelper;
use App\Enums\UserEnum;
use Illuminate\Support\Facades\Log;
use Auth;

class ProfileService extends BaseService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function update(UpdateRequest $request)
    {
        try {
            $result = Auth::user();

            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $phone = (empty($request->phone)) ? null : trim(strip_tags($request->phone));
            $email = (empty($request->email)) ? null : trim(strip_tags($request->email));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $avatar = $request->file("avatar");

            if ($avatar) {
                $upload = UploadHelper::upload_file($avatar, 'users', UserEnum::AVATAR_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $avatar = $upload["Path"];
            } else {
                $avatar = $result->avatar;
            }

            if ($password) {
                $password = bcrypt($password);
            } else {
                $password = $result->password;
            }

            $result->update([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'password' => $password,
                'avatar' => $avatar,
            ]);

            return $this->response(true, "Data berhasil diubah");
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
