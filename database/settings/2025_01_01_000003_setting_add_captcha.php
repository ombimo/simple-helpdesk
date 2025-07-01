<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('ticket.captcha')) {
            $this->migrator->add('ticket.captcha', false);
        }

        if (! $this->migrator->exists('app.turnstile_site_key')) {
            $this->migrator->add('app.turnstile_site_key', null);
        }

        if (! $this->migrator->exists('app.turnstile_secret_key')) {
            $this->migrator->add('app.turnstile_secret_key', null);
        }
    }
};
