<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class DashboardSetting extends Settings
{
    public ?string $logo_light_lg;

    public ?string $logo_light_sm;

    public ?string $logo_auth;

    public ?string $favicon;

    public ?string $title;

    public ?string $footer;

    public static function group(): string
    {
        return 'dashboard';
    }
}
