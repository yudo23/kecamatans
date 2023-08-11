<?php

namespace App\Services;

use App\Enums\AnnouncementEnum;
use App\Helpers\SlugHelper;
use App\Services\BaseService;
use App\Helpers\UploadHelper;
use App\Http\Requests\Announcement\StoreRequest;
use App\Http\Requests\Announcement\UpdateRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class AnnouncementService extends BaseService
{
    protected $announcement;

    public function __construct()
    {
        $this->announcement = new Announcement();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));

        $table = $this->announcement;
        if (!empty($search)) {
            $table = $this->announcement->where(function ($query2) use ($search) {
                $query2->where('title', 'like', '%' . $search . '%');
            });
        }
        if(isset($status)){
            $table = $table->where("status",$status);
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
            $result = $this->announcement;
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
            $date = (empty($request->date)) ? null : trim(strip_tags($request->date));
            $title = (empty($request->title)) ? null : trim(strip_tags($request->title));
            $fragment = (empty($request->fragment)) ? null : trim(strip_tags($request->fragment));
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $image = $request->file("image");

            if ($image) {
                $upload = UploadHelper::upload_file($image, 'announcements', AnnouncementEnum::IMAGE_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $image = $upload["Path"];
            }

            $slug = SlugHelper::generate(Announcement::class,$title,"title");

            $create = $this->announcement->create([
                'date' => $date,
                'title' => $title,
                'slug' => $slug,
                'fragment' => $fragment,
                'status' => $status,
                'image' => $image,
                'announcement-trixFields' => $request->input('announcement-trixFields'),
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
            $date = (empty($request->date)) ? null : trim(strip_tags($request->date));
            $title = (empty($request->title)) ? null : trim(strip_tags($request->title));
            $fragment = (empty($request->fragment)) ? null : trim(strip_tags($request->fragment));
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $image = $request->file("image");

            $result = $this->announcement->findOrFail($id);

            if ($image) {
                $upload = UploadHelper::upload_file($image, 'announcements', AnnouncementEnum::IMAGE_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $image = $upload["Path"];
            }else{
                $image = $result->image;
            }

            if($title != $result->title){
                $slug = SlugHelper::generate(Announcement::class,$title,"title");
            }
            else{
                $slug = $result->slug;
            }

            $result->update([
                'date' => $date,
                'title' => $title,
                'slug' => $slug,
                'fragment' => $fragment,
                'status' => $status,
                'image' => $image,
                'announcement-trixFields' => $request->input('announcement-trixFields'),
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
            $result = $this->announcement->findOrFail($id);
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
            $result = $this->announcement;
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
