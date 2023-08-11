<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Services\BaseService;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Helpers\UploadHelper;
use App\Enums\UserEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use DB;
use Throwable;

class UserService extends BaseService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(Request $request, bool $paginate = true,array $column = [])
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $role = (empty($request->role)) ? null : trim(strip_tags($request->role));

        $table = $this->user;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
                $query2->orWhere('email', 'like', '%' . $search . '%');
                $query2->orWhere('phone', 'like', '%' . $search . '%');
            });
        }
        if (!empty($role)) {
            $table = $table->role($role);
        }
        if(Auth::user()->hasRole([RoleEnum::SUPERADMIN])){
            $table = $table->withTrashed();
        }
        if(count($column) >= 1){
            $table = $table->select($column);
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
            $result = $this->user;
            $result = $result->where("id",$id);
            if(Auth::user()->hasRole([RoleEnum::SUPERADMIN])){
                $result = $result->withTrashed();
            }
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

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $username = (empty($request->username)) ? null : trim(strip_tags($request->username));
            $phone = (empty($request->phone)) ? null : trim(strip_tags($request->phone));
            $email = (empty($request->email)) ? null : trim(strip_tags($request->email));
            $email_verified_at = (empty($request->email_verified_at)) ? null : trim(strip_tags($request->email_verified_at));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $roles = (empty($request->roles)) ? null : trim(strip_tags($request->roles));
            $avatar = $request->file("avatar");

            if ($avatar) {
                $upload = UploadHelper::upload_file($avatar, 'users', UserEnum::AVATAR_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $avatar = $upload["Path"];
            }

            $create = $this->user->create([
                'name' => $name,
                'username' => $username,
                'phone' => $phone,
                'email' => $email,
                'email_verified_at' => $email_verified_at,
                'password' => bcrypt($password),
                'avatar' => $avatar,
            ]);

            $create->assignRole($roles);

            DB::commit();

            return $this->response(true, 'Berhasil menambahkan data',$create);
        } catch (Throwable $th) {
            DB::rollback();
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $username = (empty($request->username)) ? null : trim(strip_tags($request->username));
            $phone = (empty($request->phone)) ? null : trim(strip_tags($request->phone));
            $email = (empty($request->email)) ? null : trim(strip_tags($request->email));
            $email_verified_at = (empty($request->email_verified_at)) ? null : trim(strip_tags($request->email_verified_at));
            $password = (empty($request->password)) ? null : trim(strip_tags($request->password));
            $roles = (empty($request->roles)) ? null : trim(strip_tags($request->roles));
            $avatar = $request->file("avatar");

            $result = $this->user;
            $result = $result->findOrFail($id);

            if ($password) {
                $password = bcrypt($password);
            } else {
                $password = $result->password;
            }

            if ($avatar) {
                $upload = UploadHelper::upload_file($avatar, 'users', UserEnum::AVATAR_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $avatar = $upload["Path"];
            } else {
                $avatar = $result->avatar;
            }

            $result->update([
                'name' => $name,
                'username' => $username,
                'phone' => $phone,
                'email' => $email,
                'email_verified_at' => $email_verified_at,
                'password' => $password,
                'avatar' => $avatar,
            ]);

            $result->syncRoles($roles);

            DB::commit();

            return $this->response(true, 'Berhasil mengubah data',$result);
        } catch (Throwable $th) {
            DB::rollback();;
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->user->findOrFail($id);
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function restore($id)
    {
        try {
            $result = $this->user->withTrashed()->findOrFail($id);
            $result->restore();

            return $this->response(true, 'Berhasil mengebalikan data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
