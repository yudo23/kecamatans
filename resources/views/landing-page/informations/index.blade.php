@extends("landing-page.layouts.main")

@section("title","Informasi Desa")

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
                            Informasi Desa
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Informasi Desa
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
                    <div class="card-body text-center" style="text-transform: uppercase;">
                        <div>
                            <p style="font-size: 30px;"><i class="fa fa-building"></i></p>
                            <p style="font-size: 20px;">DESA {{$row->village->name ?? null}}</p>
                        </div>

                        <div class="my-3">
                            <!-- Button -->
                            <a href="{{route('landing-page.informations.show',$row->slug)}}" class="btn-drive m-txt10 size8 bo3 bg1 hov-color-white bo-rad-4 d-block">
                                Lihat Informasi
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