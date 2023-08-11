<?php

namespace App\Services;

use App\Enums\BlogEnum;
use App\Helpers\SlugHelper;
use App\Services\BaseService;
use App\Helpers\UploadHelper;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class BlogService extends BaseService
{
    protected $blog;

    public function __construct()
    {
        $this->blog = new Blog();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));
        $category_id = (empty($request->category_id)) ? null : trim(strip_tags($request->category_id));
        $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));

        $table = $this->blog;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('title', 'like', '%' . $search . '%');
            });
        }
        if(!empty($category_id)){
            $table = $table->where("category_id",$category_id);
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
            $result = $this->blog;
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
            $title = (empty($request->title)) ? null : trim(strip_tags($request->title));
            $fragment = (empty($request->fragment)) ? null : trim(strip_tags($request->fragment));
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $image = $request->file("image");

            if ($image) {
                $upload = UploadHelper::upload_file($image, 'blogs', BlogEnum::IMAGE_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $image = $upload["Path"];
            }

            $slug = SlugHelper::generate(Blog::class,$title,"title");

            $create = $this->blog->create([
                'category_id' => $category_id,
                'title' => $title,
                'slug' => $slug,
                'fragment' => $fragment,
                'status' => $status,
                'image' => $image,
                'blog-trixFields' => $request->input('blog-trixFields'),
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
            $title = (empty($request->title)) ? null : trim(strip_tags($request->title));
            $fragment = (empty($request->fragment)) ? null : trim(strip_tags($request->fragment));
            $status = (!isset($request->status)) ? null : trim(strip_tags($request->status));
            $image = $request->file("image");

            $result = $this->blog->findOrFail($id);

            if ($image) {
                $upload = UploadHelper::upload_file($image, 'blogs', BlogEnum::IMAGE_EXT);

                if ($upload["IsError"] == TRUE) {
                    return $this->response(false, $upload["Message"]);
                }

                $image = $upload["Path"];
            }else{
                $image = $result->image;
            }

            if($title != $result->title){
                $slug = SlugHelper::generate(Blog::class,$title,"title");
            }
            else{
                $slug = $result->slug;
            }

            $result->update([
                'category_id' => $category_id,
                'title' => $title,
                'slug' => $slug,
                'fragment' => $fragment,
                'status' => $status,
                'image' => $image,
                'blog-trixFields' => $request->input('blog-trixFields'),
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
            $result = $this->blog->findOrFail($id);
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
            $result = $this->blog;
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

        $table = $this->blog;
        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where('title', 'like', '%' . $search . '%');
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
