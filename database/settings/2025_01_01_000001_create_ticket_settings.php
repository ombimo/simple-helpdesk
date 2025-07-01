<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ticket.phone_field', true);
        $this->migrator->add('ticket.phone_field_required', false);
        $this->migrator->add('ticket.email_field', true);
        $this->migrator->add('ticket.email_field_required', false);
    }
};
