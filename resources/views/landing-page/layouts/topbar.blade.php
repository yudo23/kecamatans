<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="top-bar bg-main">
            <div class="container">
                <div class="content-topbar">
                    <div class="left-top-bar">
                        <a href="{{route('landing-page.contact-us.index')}}">Hubungi Kami</a>
                        @if(!Auth::check())
                        <a href="{{route('dashboard.auth.login.index')}}">Login</a>
                        @else
                        <a href="{{route('dashboard.index')}}">Dashboard</a>
                        @endif
                    </div>

                    <div class="right-top-bar">
                        <span>
                            <i class="icon_phone" aria-hidden="true"></i>
                            <span>{{\SettingHelper::settings('landing_page', 'hotline')}}</span>
                        </span>

                        <span>
                            <i class="icon_pin" aria-hidden="true"></i>
                            <span>{{\SettingHelper::settings('landing_page', 'address')}}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <div class="limiter-menu-desktop">
                
                <!-- Logo desktop -->		
                <a href="{{route('landing-page.home.index')}}" class="logo">
                    <img src="{{!empty(\SettingHelper::settings('landing_page', 'logo')) ? asset(\SettingHelper::settings('landing_page', 'logo')) : URL::to('/').'/templates/landing-page/images/icons/logo.png'}}" alt="{{\SettingHelper::settings('landing_page', 'title')}}">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{route('landing-page.home.index')}}">Home</a>
                        </li>

                        <li>
                            <a href="#">Profile</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('landing-page.pages.index','histories')}}">Sejarah</a></li>
                                <li><a href="{{route('landing-page.pages.index','visi-misi')}}">Visi Misi</a></li>
                                <li><a href="{{route('landing-page.organizations.index')}}">Struktur Organisasi</a></li>
                                <li><a href="{{route('landing-page.populations.index')}}">Jumlah Penduduk</a></li>
                                <li><a href="{{route('landing-page.employees.index')}}">Kepegawaian</a></li>
                                <li><a href="{{route('landing-page.pages.index','service-hours')}}">Jam Buka Layanan</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{route('landing-page.services.index')}}">Layanan</a>
                            <ul class="sub-menu">
                                @foreach(\SettingHelper::service() as $index => $row)
                                <li><a href="{{route('landing-page.services.show',$row->slug)}}">{{$row->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li>
                            <a href="#">Informasi</a>
                            <ul class="sub-menu">
                                <li><a href="{{route('landing-page.potentials.index')}}">Potensi Desa</a></li>
                                <li><a href="{{route('landing-page.informations.index')}}">Informasi Desa</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{route('landing-page.galleries.index')}}">Galeri</a>
                        </li>

                        <li>
                            <a href="{{route('landing-page.announcements.index')}}">Pengumuman</a>
                        </li>

                        <li>
                            <a href="{{route('landing-page.blogs.index')}}">Berita</a>
                        </li>

                        <li>
                            <a href="{{route('landing-page.contact-us.index')}}">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>	
    </div>


    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <a href="{{route('landing-page.home.index')}}" class="logo-mobile">
            <img src="{{!empty(\SettingHelper::settings('landing_page', 'logo')) ? asset(\SettingHelper::settings('landing_page', 'logo')) : URL::to('/').'/templates/landing-page/images/icons/logo.png'}}" alt="{{\SettingHelper::settings('landing_page', 'title')}}">
        </a>
        

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
            
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li class="bo1-b p-t-8 p-b-8">
                <div class="left-top-bar p-l-7">
                    <a href="#">Hubungi Kami</a>
                </div>
            </li>

            @if(!empty(\SettingHelper::settings('landing_page','hotline')))
            <li class="right-top-bar bo1-b p-t-8 p-b-8">
                <span>
                    <i class="icon_phone" aria-hidden="true"></i>
                    <span>{{\SettingHelper::settings('landing_page','hotline')}}</span>
                </span>
            </li>
            @endif

            @if(!empty(\SettingHelper::settings('landing_page','address')))
            <li class="right-top-bar bo1-b p-t-8 p-b-8">
                <span>
                    <i class="icon_pin" aria-hidden="true"></i>
                    <span>{{\SettingHelper::settings('landing_page','address')}}</span>
                </span>
            </li>
            @endif
        </ul>

        <ul class="main-menu-m bg-main">
            <li class="bg-main">
                <a href="index.html">Home</a>
                <ul class="sub-menu-m">
                    <li><a href="index.html">Homepage V1</a></li>
                    <li><a href="home-02.html">Homepage V2</a></li>
                    <li><a href="home-03.html">Homepage V3</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li class="bg-main">
                <a href="#">Courses</a>
                <ul class="sub-menu-m">
                    <li><a href="#">Course List</a></li>
                    <li><a href="course-grid.html">Course Grid</a></li>
                    <li><a href="course-detail.html">Course Detail</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li class="bg-main">
                <a href="about-team.html">Teachers</a>
            </li>

            <li class="bg-main">
                <a href="#">Pages</a>
                <ul class="sub-menu-m">
                    <li><a href="photo-gallery.html">Photo Gallery</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li class="bg-main">
                <a href="blog.html">Blog</a>
                <ul class="sub-menu-m">
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li class="bg-main">
                <a href="about.html">About</a>
                <ul class="sub-menu-m">
                    <li><a href="about.html">About</a></li>
                    <li><a href="about-team.html">About Team Member</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li class="bg-main">
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>
</header>