<?php

namespace App\Filament\Pages\Admin;

use App\Enums\Locale;
use App\Settings\AppSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageAppSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = AppSettings::class;

    protected static ?string $navigationLabel = 'App Settings';

    protected static ?string $navigationGroup = 'Admin';

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.admin.app_setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('General Settings')
                    ->compact()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('System Name')
                            ->required()
                            ->default('Simple Helpdesk'),

                        Forms\Components\Select::make('locale')
                            ->label('Locale')
                            ->options(Locale::class)
                            ->default('en')
                            ->required(),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->disk('public')
                            ->directory('logos')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->imageResizeMode('contain')
                            ->imageResizeTargetWidth(300)
                            ->imageResizeTargetHeight(300)
                            ->columnSpanFull(),

                    ]),

                Forms\Components\Section::make('Cloudflare Turnstile')
                    ->compact()
                    ->schema([
                        Forms\Components\TextInput::make('turnstile_site_key')
                            ->label('Site Key'),

                        Forms\Components\TextInput::make('turnstile_secret_key')
                            ->label('Secret Key'),
                    ]),
            ]);
    }
}
