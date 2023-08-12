@extends("landing-page.layouts.main")

@section("title","Download File")

@section("css")
@endsection

@section("content")
<!-- Title page -->
<section class="bg-img-1 bg-overlay-3 p-t-93 p-b-95" style="background-image: url({{!empty(\SettingHelper::settings('landing_page', 'banner')) ? asset(\SettingHelper::settings('landing_page', 'banner')) : URL::to('/').'/templates/landing-page/assets/images/bg-title-01.jpg'}}) !important;">
    <div class="container">
        <div class="flex-w flex-sb-m">
            <div class="p-t-10 p-b-10 p-r-30">
                <div class="flex-w p-b-9">
                    <span>
                        <a href="{{route('landing-page.home.index')}}" class="s-txt19 hov-color-main trans-02">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                        <span class="s-txt19 p-l-6 p-r-9">/</span>
                    </span>

                    <span>
                        <span class="s-txt19">
                            Download File
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Download File
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-45">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($table as $index => $row)
                            <tr>
                                <td>{{$table->firstItem()+$index}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{date("d F Y H:i:s",strtotime($row->created_at))}}</td>
                                <td>
                                    <a href="{{asset($row->file)}}" class="btn btn-success btn-sm" download><i class="fa fa-download"></i> Download</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!!$table->links('vendor.pagination.bootstrap-4')!!}
            </div>
        </div>
    </div>
</section>
@endsection

@section("script")
<script>
</script>
@endsection