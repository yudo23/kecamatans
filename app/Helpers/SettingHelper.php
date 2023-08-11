<?php

namespace App\Helpers;

use App\Models\Information;
use App\Models\Potential;
use App\Models\Service;
use App\Settings\DashboardSetting;
use App\Settings\LandingPageSetting;

class SettingHelper
{
    public static function settings(string $group, string $key)
    {
        return match ($group) {
            'dashboard' => app(DashboardSetting::class)->$key,
            'landing_page' => app(LandingPageSetting::class)->$key,
            default => null,
        };
    }

    public static function service(){
        $data = new Service();
        $data = $data->get();

        return $data;
    }
}
