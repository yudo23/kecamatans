@extends("dashboard.layouts.main")

@section("title","Pengumuman")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Pengumuman</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Pengumuman</li>
                    <li class="breadcrumb-item active">Edit</li>
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
                <form method="POST" action="{{route('dashboard.announcements.update',$result->id)}}" id="frmUpdate">
                    @csrf
                    @method("PUT")
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" placeholder="Judul Pengumuman" value="{{old('title',$result->title)}}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" placeholder="Tanggal" value="{{old('date',$result->date)}}">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Gambar</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control" name="image" accept="image/*">
                            <p class="text-info" style="margin-top: 0px;margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;"><small><i>Kosongkan jika tidak diubah</i></small></p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Penggalan Konten <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="fragment" placeholder="Penggalan Konten">{{old('fragment',$result->fragment)}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Konten <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            @trix($result, 'content')
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-md-2 col-form-label">Status <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control select2" name="status" style="width: 100%;">
                                <option value="">==Pilih Status==</option>
                                @foreach($status as $index => $row)
                                <option value="{{$index}}" @if($index == $result->status) selected @endif>{{$row}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.announcements.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                            responseSuccess(resp.message,"{{route('dashboard.announcements.index')}}");
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