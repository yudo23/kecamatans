@extends("landing-page.layouts.main")

@section("title","Hubungi Kami")

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
                            Hubungi Kami
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Hubungi Kami
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8 p-b-50">
                <div>
                    <h3 class="m-txt28 rs1-color p-b-40">
                        Kirim Pesan
                    </h3>

                    <form method="post" id="frmStore" onsubmit="return confirm('Apakah anda yakin ingin mengirim data ini?')" action="{{route('landing-page.contact-us.store')}}">
                        @csrf
                        <div class="w-full m-b-20">
                            <input class="s-txt31 size5 cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18" type="text" name="name" placeholder="Nama Lengkap" style="width: 100%;">
                        </div>

                        <div class="w-full m-b-20">
                            <input class="s-txt31 size5 cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18" type="email" name="email" placeholder="Email" style="width: 100%;">
                        </div>

                        <div class="w-full m-b-20">
                            <input class="s-txt31 size5 cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18" type="text" name="subject" placeholder="Subjek" style="width: 100%;">
                        </div>

                        <div class="w-full m-b-20">
                            <textarea class="s-txt31 size22 cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18 p-t-12" name="message" placeholder="Pesan"></textarea>
                        </div>


                        <div>
                            <!-- Button -->
                            <button class="btn-drive m-txt1 size26 bg-main hov-color-white bo-rad-4">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5 col-lg-4 p-b-50">
                <div class="p-l-20 p-l-0-lg">
                    <h3 class="m-txt28 rs1-color p-b-35">
                        Temukan Kami Di
                    </h3>

                    <p class="s-txt2">
                        {{\SettingHelper::settings('landing_page', 'description')}}
                    </p>

                    <ul class="p-t-26">
                        @if(!empty(\SettingHelper::settings('landing_page', 'address')))
                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-home" aria-hidden="true"></i>
                            379 5th Ave  New York, NYC 10018
                        </li>
                        @endif
                        
                        @if(!empty(\SettingHelper::settings('landing_page', 'hotline')))
                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-fax" aria-hidden="true"></i>
                            (+1) 96 716 6879
                        </li>
                        @endif

                        @if(!empty(\SettingHelper::settings('landing_page', 'email')))
                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-envelope-o" aria-hidden="true"></i>
                            contact@site.com
                        </li>
                        @endif

                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-clock-o" aria-hidden="true"></i>
                            Mon-Fri 09:00 - 17:00
                        </li>
                    </ul>
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