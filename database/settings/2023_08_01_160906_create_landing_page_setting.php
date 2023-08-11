<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('landing_page.title',config('app.name'));
        $this->migrator->add('landing_page.keyword');
        $this->migrator->add('landing_page.description');
        $this->migrator->add('landing_page.hotline');
        $this->migrator->add('landing_page.email');
        $this->migrator->add('landing_page.instagram');
        $this->migrator->add('landing_page.youtube');
        $this->migrator->add('landing_page.twitter');
        $this->migrator->add('landing_page.facebook');
        $this->migrator->add('landing_page.whatsapp');
        $this->migrator->add('landing_page.province');
        $this->migrator->add('landing_page.city');
        $this->migrator->add('landing_page.district');
        $this->migrator->add('landing_page.address');
        $this->migrator->add('landing_page.head_of_office_name');
        $this->migrator->add('landing_page.head_of_office_image');
        $this->migrator->add('landing_page.head_of_office_quotes');
        $this->migrator->add('landing_page.logo');
        $this->migrator->add('landing_page.favicon');
        $this->migrator->add('landing_page.banner');
        $this->migrator->add('landing_page.footer', config('app.name'));
    }
};
