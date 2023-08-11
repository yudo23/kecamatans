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
                <div class="p-2">
                    <form class="form-horizontal" method="POST" action="{{route('dashboard.auth.verification.send')}}">
                        @csrf
                        
                        <p class="text-center">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        </p>

                        <div class="mt-3">
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('click here to request another') }}</button>
                        </div>
                    </form>
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