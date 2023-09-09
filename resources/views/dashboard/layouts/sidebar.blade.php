<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}"
                    alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a class="text-dark fw-medium font-size-16">{{ Auth::User()->name }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ Auth::user()->getRoleNames()->implode('') }}</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('dashboard.index')}}" class=" waves-effect">
                        <i class="fa fa-tachometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.services.index')}}" class=" waves-effect">
                        <i class="fa fa-tasks"></i>
                        <span>Layanan</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.galleries.index')}}" class=" waves-effect">
                        <i class="fa fa-picture-o"></i>
                        <span>Galeri</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-building"></i>
                        <span>Potensi Desa</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('dashboard.potential-categories.index')}}">Kategori Potensi</a></li>
                        <li><a href="{{route('dashboard.potentials.index')}}">Potensi</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('dashboard.populations.index')}}" class=" waves-effect">
                        <i class="fa fa-users"></i>
                        <span>Jumlah Penduduk</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.informations.index')}}" class=" waves-effect">
                        <i class="fa fa-info-circle"></i>
                        <span>Informasi Desa</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.announcements.index')}}" class=" waves-effect">
                        <i class="fa fa-bell"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-newspaper"></i>
                        <span>Berita</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('dashboard.blogs.index')}}">Berita</a></li>
                        <li><a href="{{route('dashboard.blog-categories.index')}}">Kategori Berita</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('dashboard.employees.index')}}" class=" waves-effect">
                        <i class="fa fa-user"></i>
                        <span>Pegawai</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.files.index')}}" class=" waves-effect">
                        <i class="fa fa-download"></i>
                        <span>Download File</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.pages.index')}}" class=" waves-effect">
                        <i class="fa fa-chrome"></i>
                        <span>Halaman</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.sliders.index')}}" class=" waves-effect">
                        <i class="fa fa-sliders"></i>
                        <span>Sliders</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.inboxs.index')}}" class=" waves-effect">
                        <i class="fa fa-envelope"></i>
                        <span>Pesan Masuk</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.indonesia.provinces.index')}}" class=" waves-effect">
                        <i class="fa fa-flag"></i>
                        <span>Wilayah Indonesia</span>
                    </a>
                </li>

                @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN,\App\Enums\RoleEnum::ADMINISTRATOR]))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('dashboard.users.index')}}">User</a></li>
                        <li><a href="{{route('dashboard.settings.dashboard.index')}}">Dashboard</a></li>
                        <li><a href="{{route('dashboard.settings.landing-page.index')}}">Landing Page</a></li>
                        @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN]))
                        <li><a href="/dashboard/user-activity">User Activity</a></li>
                        <li><a href="/dashboard/logs">Error Log</a></li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>