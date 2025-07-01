<?php

namespace App\Filament\Public\Pages;

use App\Models\Category;
use App\Models\Departement;
use App\Models\Location;
use App\Models\Ticket;
use App\Settings\TicketSettings;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Illuminate\Http\Request;

class CheckTicket extends Page implements HasForms
{
    use InteractsWithFormActions, InteractsWithForms;

    public ?array $data = [];

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static string $view = 'filament.public.pages.check-ticket';

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.public.page.check-ticket');
    }

    public function mount(Request $request)
    {
        $no = $request->string('no');
        if (empty($no)) {
            return abort(404);
        }

        $ticket = Ticket::query()
            ->where('no', $no)
            ->with(['ticketStatus'])
            ->firstOrFail();

        $this->form->fill([
            ...$ticket->toArray(),
            'ticket_status_name' => $ticket->ticketStatus?->name,
        ]);
    }

    public function form(Form $form): Form
    {
        $ticketSettings = app(TicketSettings::class);

        return $form
            ->statePath('data')
            ->columns(2)
            ->disabled()
            ->schema([
                Forms\Components\TextInput::make('no')
                    ->label('Ticket Number'),

                Forms\Components\TextInput::make('ticket_status_name')
                    ->label('Status'),

                Forms\Components\TextInput::make('name'),

                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->hidden(! $ticketSettings->phone_field)
                    ->required($ticketSettings->phone_field_required),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->hidden(! $ticketSettings->email_field)
                    ->required($ticketSettings->email_field_required),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Select::make('departement_id')
                    ->label('Departement')
                    ->options(
                        Departement::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(
                        Category::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('location_id')
                    ->label(__('form.label.location'))
                    ->options(
                        Location::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->required(),

                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->columnSpanFull()
                    ->previewable(true)
                    ->downloadable()
                    ->disk('local')
                    ->visibility('private')
                    ->openable(),
            ]);
    }
}
