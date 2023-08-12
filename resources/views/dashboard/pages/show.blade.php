@extends("dashboard.layouts.main")

@section("title","Halaman")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Halaman</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Halaman</li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row pb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Nama Halaman
                            </div>
                            <div class="col-md-8">
                                : {{$result->name}}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3">
                                Slug
                            </div>
                            <div class="col-md-8">
                                : {{$result->slug}}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3">
                                Konten
                            </div>
                            <div class="col-md-8">
                                : {!! $result->trixRender('content') !!}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3">
                                Tanggal Dibuat
                            </div>
                            <div class="col-md-8">
                                : {{ date('d-m-Y H:i:s',strtotime($result->created_at)) }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3">
                                Tanggal Diperbarui
                            </div>
                            <div class="col-md-8">
                                : {{ date('d-m-Y H:i:s',strtotime($result->updated_at)) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{route('dashboard.pages.index')}}" class="btn btn-warning btn-sm" style="margin-right: 10px;"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <a href="{{route('dashboard.pages.edit',$result->id)}}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-edit"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    $(function(){
    })
</script>
@endsection