@extends("dashboard.layouts.main")

@section("title","Provinsi")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Provinsi</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Provinsi</li>
                    <li class="breadcrumb-item active">Provinsi</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30 px-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-success btn-sm btn-filter"><i class="fa fa-filter"></i> Filter</a>
                        <a href="{{route('dashboard.galleries.index')}}" class="btn @if(!empty(request()->all())) btn-warning @else btn-secondary @endif btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="table">
                                <table class="table mb-3 table-striped table-bordred">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Provinsi</th>
                                    </thead>
                                    <tbody>
                                    @forelse($table as $index => $row)
                                    <tr>
                                        <td>{{$table->firstItem() + $index}}</td>
                                        <td>
                                            <a href="{{route('dashboard.indonesia.cities.index',['province_code' => $row->code])}}">{{$row->name}}</a>
                                        </td>
                                    </tr> 
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No data</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $table->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("dashboard.indonesia.provinces.modal.index")

@endsection

@section("script")
<script>
    $(function() {
        $(document).on("click", ".btn-filter", function(e) {
            e.preventDefault();

            $("#modalFilter").modal("show");
        });
    })
</script>
@endsection