@extends("dashboard.layouts.main")

@section("title","Pengaturan Landing Page")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Pengaturan Landing Page</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Pengaturan Landing Page</li>
                    <li class="breadcrumb-item active">Pengaturan Landing Page</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('dashboard.settings.landing-page.update')}}" id="frmUpdate" autocomplete="off">
                    @csrf
                    @method("PUT")
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Judul <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="title" placeholder="Judul" value="{{old('title',$result->title)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Kata Kunci</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="keyword" placeholder="Kata Kunci" value="{{old('keyword',$result->keyword)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Deskripsi</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" placeholder="Deskripsi" name="description">{{old('description',$result->description)}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo Navbar</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo))
                                    <div class="mb-2">
                                        <img src="{{asset($result->logo)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 309px x 69px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo Footer</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_footer))
                                    <div class="mb-2">
                                        <img src="{{asset($result->logo_footer)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_footer" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 309px x 69px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Favicon</label>
                                <div class="col-md-10">
                                    @if(!empty($result->favicon))
                                    <div class="mb-2">
                                        <img src="{{asset($result->favicon)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="favicon" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 69px x 69px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Provinsi</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="province" placeholder="Provinsi" value="{{old('province',$result->province)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Kota/Kabupaten</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="city" placeholder="Kota/Kabupaten" value="{{old('city',$result->city)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Kecamatan</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="district" placeholder="Kecamatan" value="{{old('district',$result->district)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Alamat Lengkap</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="address" placeholder="Alamat Lengkap" value="{{old('address',$result->address)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email',$result->email)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Hotline</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="hotline" placeholder="Hotline" value="{{old('hotline',$result->hotline)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Instagram</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="instagram" placeholder="Instagram" value="{{old('instagram',$result->instagram)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Youtube</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="youtube" placeholder="Youtube" value="{{old('youtube',$result->youtube)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Facebook</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="facebook" placeholder="Facebook" value="{{old('facebook',$result->facebook)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Twitter</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="twitter" placeholder="Twitter" value="{{old('twitter',$result->twitter)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Whatsapp</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp" value="{{old('whatsapp',$result->whatsapp)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Nama Camat</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="head_of_office_name" placeholder="Nama Camat" value="{{old('head_of_office_name',$result->head_of_office_name)}}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Foto Camat</label>
                                <div class="col-md-10">
                                    @if(!empty($result->head_of_office_image))
                                    <div class="mb-2">
                                        <img src="{{asset($result->head_of_office_image)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="head_of_office_image" accept="image/*">
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Sambutan Camat</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" placeholder="Sambutan Camat" name="head_of_office_quotes">{{old('head_of_office_quotes',$result->head_of_office_quotes)}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Struktur Organisasi</label>
                                <div class="col-md-10">
                                    @if(!empty($result->organization))
                                    <div class="mb-2">
                                        <img src="{{asset($result->organization)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="organization" accept="image/*">
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Banner Halaman</label>
                                <div class="col-md-10">
                                    @if(!empty($result->banner))
                                    <div class="mb-2">
                                        <img src="{{asset($result->banner)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="banner" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 1905px x 276px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Footer <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="footer" placeholder="Footer" value="{{old('footer',$result->footer)}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    $(function(){

        $('button[type="submit"]').attr("disabled",false);

        $(document).on('submit','#frmUpdate',function(e){
            e.preventDefault();
            if(confirm("Apakah anda yakin ingin menyimpan data ini ?")){
                $.ajax({
                    url : $("#frmUpdate").attr("action"),
                    method : "POST",
                    data : new FormData($('#frmUpdate')[0]),
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType : "JSON",
                    beforeSend : function(){
                        return openLoader();
                    },
                    success : function(resp){
                        if(resp.success == false){
                            responseFailed(resp.message);                   
                        }
                        else{
                            responseSuccess(resp.message,"{{route('dashboard.settings.landing-page.index')}}");
                        }
                    },
                    error: function (request, status, error) {
                        if(request.status == 422){
                            responseFailed(request.responseJSON.message);
                        }
                        else{
                            responseInternalServerError();
                        }
                    },
                    complete :function(){
                        return closeLoader();
                    }
                })
            }
        })
    })
</script>
@endsection