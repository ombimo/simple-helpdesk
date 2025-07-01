<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TicketSettings extends Settings
{
    public bool $phone_field = true;

    public bool $phone_field_required = false;

    public bool $email_field = true;

    public bool $email_field_required = false;

    public bool $captcha = false;

    public static function group(): string
    {
        return 'ticket';
    }
}
