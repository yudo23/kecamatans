<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Population\StoreRequest;
use App\Http\Requests\Population\UpdateRequest;
use App\Models\Population;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class PopulationService extends BaseService
{
    protected $populationService;

    public function __construct()
    {
        $this->populationService = new Population();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

        $table = $this->populationService;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('total', 'like', '%' . $search . '%');
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
            $result = $this->populationService;
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
            $total = (empty($request->total)) ? null : trim(strip_tags($request->total));

            $create = $this->populationService->create([
                'village_code' => $village_code,
                'total' => $total,
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
            $total = (empty($request->total)) ? null : trim(strip_tags($request->total));

            $result = $this->populationService->findOrFail($id);

            $result->update([
                'village_code' => $village_code,
                'total' => $total,
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
            $result = $this->populationService->findOrFail($id);
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
