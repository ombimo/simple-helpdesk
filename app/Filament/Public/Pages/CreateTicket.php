<?php

namespace App\Filament\Public\Pages;

use Afatmustafa\FilamentTurnstile\Forms\Components\Turnstile;
use App\Models\Category;
use App\Models\Departement;
use App\Models\Location;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Services\TicketService;
use App\Settings\TicketSettings;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;

class CreateTicket extends Page implements HasForms
{
    use InteractsWithFormActions, InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static string $view = 'filament.public.pages.create-ticket';

    public function getHeading(): string|Htmlable
    {
        return __('app.navigation-label.create-ticket');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.navigation-label.create-ticket');
    }

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.public.page.create-ticket');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $ticketSettings = app(TicketSettings::class);

        return $form
            ->statePath('data')
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('form.label.name'))
                    ->placeholder(__('form.placeholder.name'))
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->label(__('form.label.phone'))
                    ->placeholder(__('form.placeholder.phone'))
                    ->tel()
                    ->hidden(! $ticketSettings->phone_field)
                    ->required($ticketSettings->phone_field_required),

                Forms\Components\TextInput::make('email')
                    ->label(__('form.label.email'))
                    ->placeholder(__('form.placeholder.email'))
                    ->email()
                    ->hidden(! $ticketSettings->email_field)
                    ->required($ticketSettings->email_field_required),

                Forms\Components\TextInput::make('title')
                    ->label(__('form.label.title'))
                    ->placeholder(__('form.label.title'))
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Select::make('departement_id')
                    ->label(__('form.label.departement'))
                    ->options(
                        Departement::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->label(__('form.label.category'))
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

                Turnstile::make('turnstile')
                    ->visible($ticketSettings->captcha),
            ]);
    }

    public function submit(Action $action): void
    {
        $ticketService = app(TicketService::class);
        $formState = $this->form->getState();

        $defaultStatus = TicketStatus::query()
            ->where('is_default', true)
            ->first();

        $ticket = new Ticket;
        $ticket->fill($formState);
        $ticket->ticket_status_id = $defaultStatus?->id;
        $ticket->periode = now()->format('Y-m-01');
        $ticket->no = $ticketService->generateTicketNumber($ticket->category?->prefix_no ?? 'GEN', $ticket->periode);

        try {
            $ticket->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($ticket);

            Notification::make()
                ->title('Gagal Membuat Tiket')
                ->danger()
                ->send();

            return;
        }

        $this->form->fill();
        Notification::make()
            ->title('Ticket Created Successfully')
            ->success()
            ->send();
        $action->success();

        $this->redirect(CheckTicket::getUrl([
            'no' => $ticket->no,
        ]));
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSubmitFormAction(),
        ];
    }

    protected function getSubmitFormAction(): Action
    {
        return Action::make('save')
            ->label(__('button.create_ticket'))
            ->submit('submit')
            ->keyBindings(['mod+s']);
    }
}
