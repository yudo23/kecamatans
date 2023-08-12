<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-end">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="mdi mdi-bell-outline"></i>
                        <span @class([
                            "badge rounded-pill bg-danger",
                            "d-none" => Auth::user()->unreadNotifications->count() == 0
                        ]) id="notifCount">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifikasi </h6>
                                </div>
                            </div>
                        </div>
                        <div style="max-height: 230px; overflow-y: auto" id="notifList">
                            @forelse(Auth::user()->notifications->take(10) as $notification)
                                <a href="{{ route("dashboard.notification.read", $notification) }}" class="text-reset notification-item">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-bell"></i>
                                        </span>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1">
                                                {{ $notification->data['title'] }}
                                                @if(empty($notification->read_at))
                                                    <span class="badge badge-soft-danger float-end py-1 px-3">NEW</span>
                                                @endif
                                            </h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">{{ $notification->data['message'] }}</p>
                                                <p class="mb-1"><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-3 text-center" id="notifEmpty">
                                    <h6 class="m-0">Tidak ada notifikasi</h6>
                                </div>
                            @endforelse
                        </div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 " href="{{ route('dashboard.notification') }}">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}"
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}"><i
                                class="bx bx-user font-size-16 align-middle me-1"></i>
                            Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('dashboard.auth.logout') }}">
                            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                            @if(session('impersonated_by')) Leave Impersonate @else Logout @endif
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">

                    <a href="{{route('dashboard.index')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{!empty(\SettingHelper::settings('dashboard', 'logo_light_sm')) ? asset(\SettingHelper::settings('dashboard', 'logo_light_sm')) : URL::to('/').'/templates/dashboard/assets/images/logo-sm.png'}}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{!empty(\SettingHelper::settings('dashboard', 'logo_light_lg')) ? asset(\SettingHelper::settings('dashboard', 'logo_light_lg')) : URL::to('/').'/templates/dashboard/assets/images/logo-light.png'}}" alt="" height="19">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header>