@extends("landing-page.layouts.main")

@section("title","Informasi")

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
                        <a href="{{route('landing-page.informations.index')}}" class="s-txt19 hov-color-main trans-02">
                            Informasi
                        </a>
                        <span class="s-txt19 p-l-6 p-r-9">/</span>
                    </span>

                    <span>
                        <span class="s-txt19">
                            {{$result->village->name ?? null}}
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    {{$result->village->name ?? null}}
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mb-5"><b>{{$result->village->name ?? null}}</b></h3>
                <p>{!!$result->trixRender("content")!!}</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section("script")
<script>
</script>
@endsection