@extends("landing-page.layouts.main")

@section("title","Layanan")

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
                            Layanan
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Layanan
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-60">
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach($table as $index => $row)
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
@endsection

@section("script")
<script>
</script>
@endsection