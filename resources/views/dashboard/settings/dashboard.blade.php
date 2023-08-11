@extends("dashboard.layouts.main")

@section("title","Pengaturan Dashboard")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Pengaturan Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Pengaturan Dashboard</li>
                    <li class="breadcrumb-item active">Pengaturan Dashboard</li>
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
                <form action="{{route('dashboard.settings.dashboard.update')}}" id="frmUpdate" autocomplete="off">
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
                                <label class="col-md-2 col-form-label">Logo (Large)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_light_lg))
                                    <div class="mb-2">
                                        <img src="{{asset($result->logo_light_lg)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_light_lg" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 1018px x 200px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo (Small)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_light_sm))
                                    <div class="mb-2">
                                        <img src="{{asset($result->logo_light_sm)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_light_sm" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 198px x 198px</i></small></p>
                                    <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-2 col-form-label">Logo (Auth)</label>
                                <div class="col-md-10">
                                    @if(!empty($result->logo_auth))
                                    <div class="mb-2">
                                        <img src="{{asset($result->logo_auth)}}" style="width: 100px;height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control" name="logo_auth" accept="image/*">
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 198px x 198px</i></small></p>
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
                                    <p class="text-success" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Ukuran direkomendasikan 64px x 64px</i></small></p>
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
                            responseSuccess(resp.message,"{{route('dashboard.settings.dashboard.index')}}");
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