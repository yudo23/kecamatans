<?php

namespace App\Services\Auth;

use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Enums\RoleEnum;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Log;

/**
 * Class LoginService.
 */
class LoginService extends BaseService
{
    public function login(LoginRequest $request)
    {
        try {
            $username = (empty($request->username)) ? null : trim(strip_tags($request->username));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $rememberme = (empty($request->rememberme)) ? null : trim(strip_tags($request->rememberme));

            $type = (filter_var($username, FILTER_VALIDATE_EMAIL)) ? "email" : "username";

            $field = [
                $type => $username,
                'password' => $password,
            ];

            if (Auth::attempt($field, $rememberme)) {
                if (!Auth::user()->hasRole([
                    RoleEnum::SUPERADMIN,
                    RoleEnum::ADMINISTRATOR,
                ])) {
                    Auth::logout();
                    return $this->response(true, "Login berhasil");
                }
            } else {
                return $this->response(false, "Username / password tidak sesuai");
            }

            return $this->response(true, "Login berhasil");
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
