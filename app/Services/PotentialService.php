<?php

namespace App\Services;

use App\Enums\PotentialEnum;
use App\Helpers\SlugHelper;
use App\Services\BaseService;
use App\Helpers\UploadHelper;
use App\Http\Requests\Potential\StoreRequest;
use App\Http\Requests\Potential\UpdateRequest;
use App\Models\Potential;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class PotentialService extends BaseService
{
    protected $potential;

    public function __construct()
    {
        $this->potential = new Potential();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $category_id = (empty($request->category_id)) ? null : trim(strip_tags($request->category_id));
        $village_code = (empty($request->village_code)) ? null : trim(strip_tags($request->village_code));

        $table = $this->potential;
        if (!empty($search)) {
            $table = $this->potential->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
            });
        }
        if(!empty($category_id)){
            $table = $table->where("category_id",$category_id);
        }
        if(!empty($village_code)){
            $table = $table->where("village_code",$village_code);
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
            $result = $this->potential;
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
            $category_id = (empty($request->category_id)) ? null : trim(strip_tags($request->category_id));
            $village_code = (empty($request->village_code)) ? null : trim(strip_tags($request->village_code));
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $image = $request->file("image");

            if ($image) {
                $upload = UploadHelper::upload_file($image, 'potentials', PotentialEnum::IMAGE_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $image = $upload["Path"];
            }

            $slug = SlugHelper::generate(Potential::class,$name,"name");

            $create = $this->potential->create([
                'category_id' => $category_id,
                'village_code' => $village_code,
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'potential-trixFields' => $request->input('potential-trixFields'),
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
            $category_id = (empty($request->category_id)) ? null : trim(strip_tags($request->category_id));
            $village_code = (empty($request->village_code)) ? null : trim(strip_tags($request->village_code));
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $image = $request->file("image");

            $result = $this->potential->findOrFail($id);

            if ($image) {
                $upload = UploadHelper::upload_file($image, 'potentials', PotentialEnum::IMAGE_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $image = $upload["Path"];
            }else{
                $image = $result->image;
            }

            if($result->name != $name){
                $slug = SlugHelper::generate(Potential::class,$name,"name");
            }
            else{
                $slug = $result->slug;
            }

            $result->update([
                'category_id' => $category_id,
                'village_code' => $village_code,
                'name' => $name,
                'slug' => $slug,
                'image' => $image,
                'potential-trixFields' => $request->input('potential-trixFields'),
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
            $result = $this->potential->findOrFail($id);
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
            $result = $this->potential;
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

    public function getBlogByCategorySlug(Request $request,$slug,bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

        $table = $this->potential;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
            });
        }
        $table = $table->whereHas("category",function($query2) use($slug){
            $query2->where("slug",$slug);
        });
        $table = $table->orderBy('created_at', 'DESC');

        if($paginate){
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        }
        else{
            $table = $table->get();
        }

        return $this->response(true, 'Berhasil mendapatkan data', $table);
    }
}
