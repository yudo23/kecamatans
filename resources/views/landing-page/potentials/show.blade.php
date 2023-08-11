@extends("landing-page.layouts.main")

@section("name","Potensi Desa")

@section("css")
@endsection

@section("content")
<!-- name page -->
<section class="bg-img-1 bg-overlay-3 p-t-93 p-b-95" style="background-image: url({{!empty(\SettingHelper::settings('landing_page', 'banner')) ? asset(\SettingHelper::settings('landing_page', 'banner')) : URL::to('/').'/templates/landing-page/assets/images/bg-name-01.jpg'}}) !important;">
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
                        <a href="{{route('landing-page.potentials.index')}}" class="s-txt19 hov-color-main trans-02">
                            Potensi Desa
                        </a>
                        <span class="s-txt19 p-l-6 p-r-9">/</span>
                    </span>

                    <span>
                        <a href="#" class="s-txt19 hov-color-main trans-02">
                            DESA {{$result->village->name ?? null}}
                        </a>
                        <span class="s-txt19 p-l-6 p-r-9">/</span>
                    </span>

                    <span>
                        <span class="s-txt19">
                            {{$result->name}}
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    {{$result->name}}
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-45">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-50">
                <div class="p-r-40 p-r-0-lg">
                    <!-- Content Detail -->
                    <div class="p-b-48">
                        <h3 class="m-txt21 p-b-25">
                            {{$result->name}}
                        </h3>

                        <div class="flex-w flex-m s-txt29 bo2-b p-b-15">

                            <span>
                                DESA {{$result->village->name}}
                                <span class="m-l-4 m-r-9">|</span>
                            </span> 

                            <span>
                                {{$result->category->name ?? null}}
                            </span>
                        </div>

                        <div class="wrap-pic-w pos-relative m-t-30 m-b-40">
                            <img src="{{asset($result->image)}}" alt="{{$result->name}}">
                        </div>
                        
                        <p class="s-txt2 p-b-25">
                            {!!$result->trixRender("content")!!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 p-b-50">
                <!-- Sidebar -->
                <div class="p-t-5">
                    
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

                    <div class="p-t-54">
                        <h4 class="m-txt24 p-b-34">
                            Potensi Desa
                        </h4>

                        <ul>
                            @foreach($potentials as $index => $row)
                            <li class="flex-t p-b-26">
                                <a href="#" class="dis-block wrap-pic-w w-size11 overlay1 m-r-17">
                                    <img src="{{asset($row->image)}}" alt="{{$row->name}}">
                                </a>

                                <div class="w-size12 flex-col">
                                    <a href="#" class="s-txt27 hov-color-main trans-03 p-b-13">
                                        {{$row->name}}
                                    </a>

                                    <span class="s-txt28">
                                        DESA {{$row->village->name ?? null}}
                                    </span>
                                </div>
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