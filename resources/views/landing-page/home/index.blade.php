@extends("landing-page.layouts.main")

@section("title","Home")

@section("css")
@endsection

@section("content")
<!-- Slide -->
<section class="slider">
    <div class="rev_slider_wrapper fullwidthbanner-container rs1-revo">
        <div id="rev_slider_1" class="rev_slider fullwidthabanner" data-version="5.4.5" style="display:none">
            <ul>
                @foreach($sliders as $index => $row)
                <li data-transition="fade">
                    <img src="{{$row->image}}" alt="IMG-SLIDE" class="rev-slidebg">
                </li>
                @endforeach
            </ul>				
        </div>
    </div>
</section>

<!-- Featured -->
<section class="bgwhite p-t-70 p-b-40">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 mb-3">
                <h3 class="mb-3"><b>SAMBUTAN CAMAT</b></h3>
                <p class="mb-5">{{\SettingHelper::settings('landing_page', 'head_of_office_quotes')}}</p>
                <p>--{{\SettingHelper::settings('landing_page', 'head_of_office_name')}}--</p>
            </div>
            <div class="col-md-4 mb-3" style="height: 320px;">
                <img src="{{asset(\SettingHelper::settings('landing_page', 'head_of_office_image'))}}" alt="{{\SettingHelper::settings('landing_page', 'head_of_office_name')}}" style="height: 100%;width:100%">
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="bg1 p-t-75 p-b-90 features">
    <div class="container">
        <div>
            <h3 class="m-txt4 txt-center p-b-8 respon1">
                LAYANAN
            </h3>

            <div class="bg-main size2 bo-rad-3 m-lr-auto"></div>
        </div>

        <div class="row d-flex justify-content-center">
            @foreach($services as $index => $row)
            <div class="flex-str col-sm-12 col-md-4 p-t-65">
                <div class="block-2">
                    <div class="wrap-b2 p-t-60 p-b-30 p-l-19 p-r-19">
                        <div class="wrap-symbol-b2">	
                            <div class="symbol-1 rotate-symbol-1">
                                <i class="fa fa-tasks " aria-hidden="true"></i>
                            </div>
                        </div>

                        <h4 class="m-txt5 txt-center p-b-8">
                            {{$row->name}}
                        </h4>

                        <div class="my-3 text-center">
                            <!-- Button -->
                            <a href="{{route('landing-page.services.show',$row->slug)}}" class="btn-drive m-txt10 size8 bo3 bg1 hov-color-white bo-rad-4 d-block">
                                BUKA
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="bgwhite p-t-75 p-b-90">
    <div class=" p-b-10">
        <div class="p-b-24">
            <h3 class="m-txt4 txt-center p-b-8 respon1">
                PENGUMUMAN TERBARU
            </h3>

            <div class="bg-main size2 bo-rad-3 m-lr-auto"></div>
        </div>
    </div>
    <div class="container-slick-2">
        <div class="wrap-slick-2">
            <div class="slick-2 js-slick-2">
                @foreach($announcements as $index => $row)
                <div class="item-slick-2 m-l-15 m-r-15">
                    <!-- Block 4 -->
                    <div class="block-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="wrap-pic-b4 wrap-pic-w hov5">
                                    <a href="{{route('landing-page.announcements.show',$row->slug)}}"><img src="{{asset($row->image)}}" alt="{{$row->title}}"></a>
                                </div>

                                <div class="wrap-text-b4 p-t-23">
                                    <a href="{{route('landing-page.announcements.show',$row->slug)}}"><h4 class="m-txt8 hov-color-main trans-04 m-b-10">
                                        {{$row->title}}
                                    </h4></a>
                                    
                                    <span class="s-txt7">{{date("d F Y H:i:s",strtotime($row->created_at))}}</span>

                                    <p class="s-txt2 p-t-11 p-b-22">
                                        {{$row->fragment}}
                                    </p>

                                    <div class="wrap-btn-b4 flex-w">
                                        <!-- Button -->
                                        <a href="{{route('landing-page.announcements.show',$row->slug)}}" class="btn-drive m-txt10 size8 bo3 bg1 hov-color-white bo-rad-4">
                                            Lanjutkan Membaca
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bg1 p-t-75 p-b-90 features">
    <div class="container">
        <div>
            <h3 class="m-txt4 txt-center p-b-8 respon1">
                GALERI FOTO
            </h3>

            <div class="bg-main size2 bo-rad-3 m-lr-auto"></div>
        </div>

        <div class="row isotope-grid isotope-grid-gallery p-t-65 d-flex justify-content-center">
            <!-- - -->
            @foreach($galleries as $index => $row)
            <div class="col-6 col-md-4 p-b-30 isotope-item driving-dr experience-dr lessons-dr">
                <a class="wrap-pic-w dis-block overlay1" href="{{asset($row->image)}}" data-lightbox="all-gallery">
                    <img src="{{asset($row->image)}}" alt="{{$row->name}}">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Lastest News -->
<section class="bgwhite p-t-75 p-b-90">
    <div class=" p-b-10">
        <div class="p-b-24">
            <h3 class="m-txt4 txt-center p-b-8 respon1">
                BERITA TERBARU
            </h3>

            <div class="bg-main size2 bo-rad-3 m-lr-auto"></div>
        </div>
    </div>
    <div class="container-slick-2">
        <div class="wrap-slick-2">
            <div class="slick-2 js-slick-2">
                @foreach($blogs as $index => $row)
                <div class="item-slick-2 m-l-15 m-r-15">
                    <!-- Block 4 -->
                    <div class="block-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="wrap-pic-b4 wrap-pic-w hov5">
                                    <a href="{{route('landing-page.blogs.show',$row->slug)}}"><img src="{{asset($row->image)}}" alt="{{$row->title}}"></a>
                                </div>

                                <div class="wrap-text-b4 p-t-23">
                                    <a href="{{route('landing-page.blogs.show',$row->slug)}}"><h4 class="m-txt8 hov-color-main trans-04 m-b-10">
                                        {{$row->title}}
                                    </h4></a>
                                    
                                    <span class="s-txt7">{{date("d F Y H:i:s",strtotime($row->created_at))}} | </span>
                                    <a href="{{route('landing-page.blogs.categories',$row->category->slug ?? null)}}" class="dis-inline s-txt8 hov-color-main">{{$row->category->name ?? null}}</a>

                                    <p class="s-txt2 p-t-11 p-b-22">
                                        {{$row->fragment}}
                                    </p>

                                    <div class="wrap-btn-b4 flex-w">
                                        <!-- Button -->
                                        <a href="{{route('landing-page.blogs.show',$row->slug)}}" class="btn-drive m-txt10 size8 bo3 bg1 hov-color-white bo-rad-4">
                                            Lanjutkan Membaca
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section("script")
<script>
</script>
@endsection