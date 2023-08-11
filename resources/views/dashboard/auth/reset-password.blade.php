@extends("dashboard.auth.layouts.main")

@section("title","Reset Password")

@section("css")
@endsection

@section("content")
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-login text-center">
                <div class="bg-login-overlay"></div>
                <div class="position-relative">
                    <h5 class="text-white font-size-20">Reset Password</h5>
                    <p class="text-white-50 mb-0">Masukkan alamat email dan kata sandi terbaru Anda.<br> Pastikan Anda mencatat kata sandi tersebut, agar Anda tidak kehilangannya kembali.</p>
                    @include("dashboard.auth.layouts.logo")
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="p-2">
                    <form class="form-horizontal" method="POST" action="{{route('dashboard.auth.reset-password.post')}}">
                        @csrf
                        <input type="hidden" name="token" value="{{request()->get('token')}}">
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{request()->get('email')}}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation">
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset Password</button>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{route('dashboard.auth.forgot-password.index')}}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Lupa password?</a>
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