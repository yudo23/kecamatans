@extends("landing-page.layouts.main")

@section("title","Potensi Desa")

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
                            Potensi Desa
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Potensi Desa
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-45">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-50">
                <div class="row d-flex justify-content-center">

                    @foreach($table as $index => $row)
                    <div class="col-sm-6 p-b-45 isotope-item driving-dr experience-dr lessons-dr">
                        <!-- Block 4 -->
                        <div class="block-4">
                            <div class="wrap-pic-b4 wrap-pic-w hov5">
                                <a href="{{route('landing-page.potentials.show',$row->slug)}}"><img src="{{asset($row->image)}}" alt="IMG-NEWS"></a>
                            </div>

                            <div class="wrap-text-b4 p-t-23">
                                <a href="{{route('landing-page.potentials.show',$row->slug)}}"><h4 class="m-txt8 hov-color-main trans-04 m-b-17">
                                    {{$row->name}}
                                </h4></a>

                                <span class="s-txt7">DESA {{$row->village->name ?? null}} | </span>
                                <a href="{{route('landing-page.potentials.categories',$row->category->slug ?? null)}}" class="dis-inline s-txt8 hov-color-main">{{$row->category->name ?? null}}</a>

                                <div class="text-center mt-2">
                                    <!-- Button -->
                                    <a href="{{route('landing-page.potentials.show',$row->slug)}}" class="btn-drive m-txt10 size8 bo3 bg1 hov-color-white bo-rad-4 d-block">
                                        Lanjutkan Membaca
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-md-4 col-lg-3 p-b-50">
                <!-- Sidebar -->
                <div class="p-t-5">
                    <!-- search -->
                    <form action="">
                        <div class="where1-parent w-full">
                            <input class="size20 bo2 s-txt2 p-l-19 p-r-55" type="text" name="search" placeholder="Pencarian">
                            <button class="flex-c-m size21 bg4 where1 fs-16 color-white hov-bg-main trans-03" type="submit">
                                <i class="icon_search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Categories -->
                    <div class="p-t-54">
                        <h4 class="m-txt24 p-b-34">
                            Kategori
                        </h4>

                        <ul class="bo2-t">
                            @foreach($categories as $index => $row)
                            <li class="bo2-b p-t-9 p-b-8">
                                <a href="{{route('landing-page.potentials.categories',$row->slug)}}" class="s-txt2 hov-color-main trans-04">
                                    {{$row->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section("script")
<script>
</script>
@endsection