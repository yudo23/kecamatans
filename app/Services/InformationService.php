<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Http\Requests\Information\StoreRequest;
use App\Http\Requests\Information\UpdateRequest;
use App\Models\Information;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class InformationService extends BaseService
{
    protected $information;

    public function __construct()
    {
        $this->information = new Information();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $table = $this->information;
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
            $result = $this->information;
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

    public function store(StoreRequest $request)
    {
        try {
            $village_code = (empty($request->village_code)) ? null : trim(strip_tags($request->village_code));

            $slug = Str::random(100);

            $create = $this->information->create([
                'village_code' => $village_code,
                'slug' => $slug,
                'information-trixFields' => $request->input('information-trixFields'),
            ]);

            return $this->response(true, 'Berhasil menambahkan data',$create);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $village_code = (empty($request->village_code)) ? null : trim(strip_tags($request->village_code));

            $result = $this->information->findOrFail($id);

            $result->update([
                'village_code' => $village_code,
                'information-trixFields' => $request->input('information-trixFields'),
            ]);

            return $this->response(true, 'Berhasil mengubah data',$result);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->information->findOrFail($id);
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function showBySlug($slug)
    {
        try {
            $result = $this->information;
            $result = $result->where('slug',$slug);
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
}
