<a href="{{route('dashboard.auth.login.index')}}" class="logo logo-admin mt-4">
    <img src="{{!empty(\SettingHelper::settings('dashboard', 'logo_auth')) ? asset(\SettingHelper::settings('dashboard', 'logo_auth')) : URL::to('/').'/templates/dashboard/assets/images/logo-sm-dark.png'}}" alt="" height="30">
</a>