<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LandingPageSetting extends Settings
{
    public ?string $title;

    public ?string $keyword;

    public ?string $logo;

    public ?string $favicon;

    public ?string $banner;

    public ?string $description;

    public ?string $email;
    
    public ?string $hotline;

    public ?string $province;

    public ?string $city;

    public ?string $district;

    public ?string $address;

    public ?string $instagram;

    public ?string $youtube;

    public ?string $twitter;

    public ?string $whatsapp;

    public ?string $facebook;

    public ?string $head_of_office_name;

    public ?string $head_of_office_image;
    
    public ?string $head_of_office_quotes;

    public ?string $footer;
    
    public ?string $organization;

    public static function group(): string
    {
        return 'landing_page';
    }
}
