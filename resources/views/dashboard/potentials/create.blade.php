@extends("dashboard.layouts.main")

@section("title","Potensi Desa")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Potensi Desa</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Potensi Desa</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
@trixassets
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('dashboard.potentials.store')}}" id="frmStore">
                    @csrf
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2" name="category_id" style="width: 100%;">
                                <option value="">==Pilih Kategori==</option>
                                @foreach($categories as $index => $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Nama Potensi Desa <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" placeholder="Nama Potensi Desa" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Gambar <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Konten <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            @trix(\App\Models\Potential::class, 'content')
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Provinsi <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-province" style="width: 100%;">
                                <option value="">==Pilih Provinsi==</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-city" style="width: 100%;">
                                <option value="">==Pilih Kota/Kabupaten==</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Kecamatan <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-district" style="width: 100%;">
                                <option value="">==Pilih Kecamatan==</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Desa <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select-village" name="village_code" style="width: 100%;">
                                <option value="">==Pilih Desa==</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.potentials.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm" disabled><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection

@section("script")
<script>
    $(function(){
        $('button[type="submit"]').attr("disabled",false);

        getProvince('.select-province',null);

        $(document).on("change", ".select-province", function(e) {
            e.preventDefault();
            let val = $(this).val();

            $('.select-city').html('<option value="">==Pilih Kota/Kabupaten==</option>');
            $('.select-district').html('<option value="">==Pilih Kecamatan==</option>');
            $('.select-village').html('<option value="">==Pilih Desa==</option>');

            if(val != "" && val != undefined && val != null){
                getCity('.select-city',val,null);
            }
        });

        $(document).on("change", ".select-city", function(e) {
            e.preventDefault();
            let val = $(this).val();

            $('.select-district').html('<option value="">==Pilih Kecamatan==</option>');
            $('.select-village').html('<option value="">==Pilih Desa==</option>');

            if(val != "" && val != undefined && val != null){
                getDistrict('.select-district',val,null);
            }
        });

        $(document).on("change", ".select-district", function(e) {
            e.preventDefault();
            let val = $(this).val();

            $('.select-village').html('<option value="">==Pilih Desa==</option>');

            if(val != "" && val != undefined && val != null){
                getVillage('.select-village',val,null);
            }
        });

        $(document).on('submit','#frmStore',function(e){
            e.preventDefault();
            if(confirm("Apakah anda yakin ingin menyimpan data ini ?")){
                $.ajax({
                    url : $("#frmStore").attr("action"),
                    method : "POST",
                    data : new FormData($('#frmStore')[0]),
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
                            responseSuccess(resp.message,"{{route('dashboard.potentials.index')}}");
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