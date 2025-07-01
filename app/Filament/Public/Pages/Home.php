<?php

namespace App\Filament\Public\Pages;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Home extends Page
{
    use InteractsWithActions;
    use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.public.pages.home';

    public function getHeading(): string|Htmlable
    {
        return __('app.navigation-label.home');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.navigation-label.home');
    }

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.public.page.home');
    }

    public function ticketInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Actions::make([
                            Action::make('createTicket')
                                ->label(__('app.navigation-label.create-ticket'))
                                ->icon('heroicon-o-document-plus')
                                ->url(CreateTicket::getUrl())
                                ->color('primary'),
                        ])->alignCenter(),
                    ]),

            ]);
    }
}
