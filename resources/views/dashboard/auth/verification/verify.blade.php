@extends("dashboard.auth.layouts.main")

@section("title","Verifikasi Email")

@section("css")
@endsection

@section("content")
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-login text-center">
                <div class="bg-login-overlay"></div>
                <div class="position-relative">
                    <h5 class="text-white font-size-20">Welcome Back !</h5>
                    <p class="text-white-50 mb-0">{{ __('Verify Your Email Address') }}</p>
                    @include("dashboard.auth.layouts.logo")
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="p-2 text-center">
                    @auth
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                        {{ __('Kembali ke Beranda') }}
                    </a>
                    @else
                    <a href="{{ route('dashboard.auth.login.index') }}" class="btn btn-primary">
                        {{ __('Login') }}
                    </a>
                    @endauth
                </div>

            </div>
        </div>
        <div class="mt-5 text-center">
            @include("dashboard.auth.layouts.footer")
        </div>

    </div>
</div>
@endsection

@section("script")
<script>
</script>
@endsection