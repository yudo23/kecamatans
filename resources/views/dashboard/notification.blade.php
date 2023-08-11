@extends("dashboard.layouts.main")

@section("title","Notifikasi")

@section("css")
<style>
    .activity-list {
        padding-left: 86px;
    }

    .activity-list .activity-item {
        position: relative;
        padding-bottom: 26px;
        padding-left: 45px;
        border-left: 2px solid #f3f3f3;
    }

    .activity-list .activity-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 3px;
        left: -7px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #508aeb;
    }

    .activity-list .activity-item .activity-item-img img {
        max-width: 78px;
    }

    .activity-list .activity-item .activity-date {
        position: absolute;
        left: -82px;
    }

    @media (max-width: 420px) {
        .activity-list {
            padding-left: 0;
        }

        .activity-list .activity-date {
            position: relative !important;
            display: block;
            left: 0 !important;
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Notifikasi</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Notifikasi</li>
                    <li class="breadcrumb-item active">Notifikasi</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30 px-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="">Daftar Notifikasi</h4>
                    </div>
                    @if (Auth::user()->unreadNotifications->count() > 0)
                        <div class="col-md-6 text-end">
                            <a href="{{ route("dashboard.notification.markAsRead") }}" class="btn btn-primary">
                                Tandai Sudah Baca
                            </a>
                        </div>
                    @endif
                </div>
                @if ($notifications->count() > 0)
                    <ul class="my-3 list-unstyled activity-list">
                        @foreach ($notifications as $key => $notification)
                            <li class="activity-item">
                                <span class="activity-date">
                                    {{ $notification->created_at->format("d M y") }} <br>
                                    {{ $notification->created_at->format("H:i:s") }}
                                </span>
                                @if (empty($notification->read_at))
                                    <span class="badge badge-soft-danger float-end py-1 px-3">NEW</span>
                                @endif
                                <span class="activity-text">
                                    <a href="{{ route('dashboard.notification.read', $notification->id) }}">
                                    </a>
                                </span>
                                <p class="text-muted mt-2">{!! $notification->data['message'] !!}</p>
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        {!! $notifications->links() !!}
                    </div>
                @else
                    <h5 class="text-center">Tidak terdapat notifikasi</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
</script>
@endsection