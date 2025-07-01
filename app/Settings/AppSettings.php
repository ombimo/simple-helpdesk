<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public string $name = 'Simple Helpdesk';

    public string $locale = 'en';

    public ?string $logo = 'default.png';

    public ?string $turnstile_site_key = null;

    public ?string $turnstile_secret_key = null;

    public static function group(): string
    {
        return 'app';
    }
}
