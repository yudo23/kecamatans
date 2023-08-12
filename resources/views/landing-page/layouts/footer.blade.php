<footer class="bg4 p-t-25">
    <div class="container p-b-60">
        <div class="row">
            <div class=" col-sm-12 col-lg-4 p-t-30">
                <div class="w-full wrap-pic-max-w">
                    <a href="{{route('landing-page.home.index')}}"><img src="{{!empty(\SettingHelper::settings('landing_page', 'logo_footer')) ? asset(\SettingHelper::settings('landing_page', 'logo_footer')) : URL::to('/').'/templates/landing-page/images/icons/logo-02.png'}}" alt="{{\SettingHelper::settings('landing_page', 'title')}}" alt="{{\SettingHelper::settings('landing_page', 'title')}}"></a>
                </div>

                <p class="s-txt9 p-t-30">
                    {{\SettingHelper::settings('landing_page', 'description')}}
                </p>
            </div>
            
            <div class=" col-sm-6 col-lg-4 p-t-30">
                <h4 class="m-txt12 p-t-14">
                    Link Cepat
                </h4>

                <div class="wrap-link-footer p-t-28">
                    <ul class="col-left">
                        <li><a href="{{route('landing-page.home.index')}}">Home</a></li>
                        <li><a href="{{route('landing-page.pages.index','histories')}}">Sejarah</a></li>
                        <li><a href="{{route('landing-page.pages.index','visi-misi')}}">Visi Misi</a></li>
                        <li><a href="{{route('landing-page.organizations.index')}}">Struktur Organisasi</a></li>
                        <li><a href="{{route('landing-page.populations.index')}}">Jumlah Penduduk</a></li>
                        <li><a href="{{route('landing-page.employees.index')}}">Kepegawaian</a></li>
                        <li><a href="{{route('landing-page.services.index')}}">Layanan</a></li>
                    </ul>

                    <ul class="col-right">
                        <li><a href="{{route('landing-page.potentials.index')}}">Potensi Desa</a></li>
                        <li><a href="{{route('landing-page.informations.index')}}">Informasi Desa</a></li>
                        <li><a href="{{route('landing-page.galleries.index')}}">Galeri</a></li>
                        <li><a href="{{route('landing-page.announcements.index')}}">Pengumuman</a></li>
                        <li><a href="{{route('landing-page.blogs.index')}}">Berita</a></li>
                        <li><a href="{{route('landing-page.contact-us.index')}}">Hubungi Kami</a></li>
                        <li><a href="{{route('landing-page.files.index')}}">Download File</a></li>
                    </ul>
                </div>
            </div>

            <div class=" col-sm-6 col-lg-4 p-t-30">
                <h4 class="m-txt12 p-t-14">
                    Hubungi Kami
                </h4>

                <ul class="contact-footer p-t-28">
                    @if(!empty(\SettingHelper::settings('landing_page','address')))
                    <li>
                        <i class="fa fa-home" aria-hidden="true"></i>
                        {{\SettingHelper::settings('landing_page','address')}}
                    </li>
                    @endif

                    @if(!empty(\SettingHelper::settings('landing_page','hotline')))
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        {{\SettingHelper::settings('landing_page','hotline')}}
                    </li>
                    @endif

                    @if(!empty(\SettingHelper::settings('landing_page','email')))
                    <li>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        {{\SettingHelper::settings('landing_page','email')}}
                    </li>
                    @endif
                </ul>
            </div>
            
        </div>
    </div>

    <div class="bg3 txt-center p-t-19 p-b-16">
        © {{date("Y")}} {{\SettingHelper::settings('landing_page', 'footer')}}
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top hov-bg-main" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>