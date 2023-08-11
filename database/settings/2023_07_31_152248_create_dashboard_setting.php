<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {  
        $this->migrator->add('dashboard.title',config('app.name'));
        $this->migrator->add('dashboard.logo_light_lg');
        $this->migrator->add('dashboard.logo_light_sm');
        $this->migrator->add('dashboard.logo_auth');
        $this->migrator->add('dashboard.favicon');
        $this->migrator->add('dashboard.footer', config('app.name'));
    }
};
