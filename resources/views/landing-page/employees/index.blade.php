@extends("landing-page.layouts.main")

@section("title","Kepegawaian")

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
                            Kepegawaian
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Kepegawaian
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-60">
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach($table as $index => $row)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <a class="wrap-pic-w dis-block overlay1" href="{{asset($row->image)}}" data-lightbox="all-gallery">
                                <img src="{{asset($row->image)}}" style="width: 100%;height:200px;">
                            </a>
                        </div>
                        <p style="font-size: 14px;">{{$row->position}}</p>
                        <p style="font-size: 18px;">{{$row->name}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section("script")
<script>
</script>
@endsection