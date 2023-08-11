<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class IndonesiaService extends BaseService
{
    protected $province;
    protected $city;
    protected $district;
    protected $village;

    public function __construct()
    {
        $this->province = new Province();
        $this->city = new City();
        $this->district = new District();
        $this->village = new Village();
    }

    public function province($request,bool $paginate = true)
    {
        try {
            $id = (empty($request->id)) ? null : trim(strip_tags($request->id));
            $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

            $table = $this->province;
            if(!empty($search)){
                $table = $table->where(function($query2) use($search){
                    $query2->where("name","like","%".$search."%");
                });
            }
            if($id){
                $table = $table->where("id",$id);
            }
            if($paginate){
                $table = $table->paginate(10);
                $table = $table->withQueryString();
            }
            else{
                $table = $table->get();
            }

            return $this->response(true, "Data berhasil didapatkan",$table);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function city($request,bool $paginate = true)
    {
        try {
            $id = (empty($request->id)) ? null : trim(strip_tags($request->id));
            $province_code = (empty($request->province_code)) ? null : trim(strip_tags($request->province_code));
            $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

            $table = $this->city;
            if(!empty($search)){
                $table = $table->where(function($query2) use($search){
                    $query2->where("name","like","%".$search."%");
                });
            }
            if($id){
                $table = $table->where("id",$id);
            }
            if($province_code){
                $table = $table->where("province_code",$province_code);
            }
            if($paginate){
                $table = $table->paginate(10);
                $table = $table->withQueryString();
            }
            else{
                $table = $table->get();
            }

            return $this->response(true, "Data berhasil didapatkan",$table);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function district($request,bool $paginate = true)
    {
        try {
            $id = (empty($request->id)) ? null : trim(strip_tags($request->id));
            $city_code = (empty($request->city_code)) ? null : trim(strip_tags($request->city_code));
            $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

            $table = $this->district;
            if(!empty($search)){
                $table = $table->where(function($query2) use($search){
                    $query2->where("name","like","%".$search."%");
                });
            }
            if($id){
                $table = $table->where("id",$id);
            }
            if($city_code){
                $table = $table->where("city_code",$city_code);
            }
            if($paginate){
                $table = $table->paginate(10);
                $table = $table->withQueryString();
            }
            else{
                $table = $table->get();
            }

            return $this->response(true, "Data berhasil didapatkan",$table);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function village($request,bool $paginate = true)
    {
        try {
            $id = (empty($request->id)) ? null : trim(strip_tags($request->id));
            $district_code = (empty($request->district_code)) ? null : trim(strip_tags($request->district_code));
            $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

            $table = $this->village;
            if(!empty($search)){
                $table = $table->where(function($query2) use($search){
                    $query2->where("name","like","%".$search."%");
                });
            }
            if($id){
                $table = $table->where("id",$id);
            }
            if($district_code){
                $table = $table->where("district_code",$district_code);
            }
            if($paginate){
                $table = $table->paginate(10);
                $table = $table->withQueryString();
            }
            else{
                $table = $table->get();
            }

            return $this->response(true, "Data berhasil didapatkan",$table);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
