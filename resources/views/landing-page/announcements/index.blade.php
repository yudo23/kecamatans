@extends("landing-page.layouts.main")

@section("title","Pengumuman")

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
                            Pengumuman
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Pengumuman
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-45">
    <div class="container">
        <div class="row">
            <div class="col-12 p-b-50">
                <div class="row d-flex justify-content-center">
                    @foreach($table as $index => $row)
                    <div class="col-sm-6 col-md-4 p-b-45 isotope-item driving-dr experience-dr lessons-dr">
                        <!-- Block 4 -->
                        <div class="block-4">
                            <div class="wrap-pic-b4 wrap-pic-w hov5">
                                <a href="{{route('landing-page.announcements.show',$row->slug)}}"><img src="{{asset($row->image)}}" alt="IMG-NEWS"></a>
                            </div>

                            <div class="wrap-text-b4 p-t-23">
                                <a href="{{route('landing-page.announcements.show',$row->slug)}}"><h4 class="m-txt8 hov-color-main trans-04 m-b-17">
                                    {{$row->title}}
                                </h4></a>

                                <span class="s-txt7">{{date("d F Y H:i:s",strtotime($row->created_at))}}

                                <p class="s-txt2 p-t-11 p-b-22">
                                    {{$row->fragment}}
                                </p>

                                <div class="text-center">
                                    <!-- Button -->
                                    <a href="{{route('landing-page.announcements.show',$row->slug)}}" class="btn-drive m-txt10 size8 bo3 bg1 hov-color-white bo-rad-4 d-block">
                                        Lanjutkan Membaca
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

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