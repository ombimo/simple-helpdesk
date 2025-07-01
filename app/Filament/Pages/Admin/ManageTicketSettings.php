<?php

namespace App\Filament\Pages\Admin;

use App\Settings\TicketSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageTicketSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = TicketSettings::class;

    protected static ?string $navigationLabel = 'Ticket Settings';

    protected static ?string $navigationGroup = 'Admin';

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.admin.ticket_setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('phone_field')
                    ->label('Enable Phone Field')
                    ->default(true),

                Forms\Components\Toggle::make('phone_field_required')
                    ->label('Phone Field Required')
                    ->helperText('Make the phone number field mandatory.')
                    ->default(false),

                Forms\Components\Toggle::make('email_field')
                    ->label('Enable Email Field')
                    ->default(true),

                Forms\Components\Toggle::make('email_field_required')
                    ->label('Email Field Required')
                    ->helperText('Make the email address field mandatory.')
                    ->default(false),

                Forms\Components\Toggle::make('captcha')
                    ->label('Enable Captcha')
                    ->default(false),
            ]);
    }
}
