@extends("landing-page.layouts.main")

@section("title","Galeri Foto")

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
                            Galeri Foto
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Galeri Foto
                </h2>
            </div>
        </div>
    </div>
</section>

<!-- Our gallery -->
<div class="bgwhite p-t-60 p-b-60">
    <div class="container">
        
        <div class="row isotope-grid isotope-grid-gallery d-flex justify-content-center">
            <!-- - -->
            @foreach($table as $index => $row)
            <div class="col-6 col-md-4 p-b-30 isotope-item driving-dr experience-dr lessons-dr">
                <a class="wrap-pic-w dis-block overlay1" href="{{asset($row->image)}}" data-lightbox="all-gallery">
                    <img src="{{asset($row->image)}}" alt="{{$row->name}}">
                </a>
            </div>
            @endforeach
        </div>
        
    </div>
</div>
@endsection

@section("script")
<script>
</script>
@endsection