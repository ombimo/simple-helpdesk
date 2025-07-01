<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('app.locale')) {
            $this->migrator->add('app.locale', 'en');
        }

        if (! $this->migrator->exists('app.name')) {
            $this->migrator->add('app.name', 'Simple Helpdesk');
        }

        if (! $this->migrator->exists('app.logo')) {
            $this->migrator->add('app.logo', 'default.png');
        }
    }
};
