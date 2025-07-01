<?php

namespace App\Filament\Pages\Admin;

use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Page implements HasForms
{
    use InteractsWithFormActions, InteractsWithForms;

    public ?array $data = [];

    protected static bool $isDiscovered = true;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.pages.admin.edit-profile-page';

    protected static ?string $navigationLabel = 'Edit Profile';

    protected static ?string $navigationGroup = 'Admin';

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.admin.edit_profile');
    }

    public function mount(): void
    {
        $user = auth()->user();
        $this->form->fill($user->only(['name', 'email']));
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->password(),
            ]);
    }

    public function submit(Action $action): void
    {
        $formState = $this->form->getState();

        $user = auth()->user();
        $user->name = $formState['name'];
        $user->email = $formState['email'];

        if (! empty($formState['password'])) {
            $user->password = Hash::make($formState['password']);
        }

        $user->save();

        if ($user->wasChanged('password')) {
            $this->redirect(EditProfile::getUrl());
        }

        Notification::make()
            ->title('profile Successfully')
            ->success()
            ->send();
        $action->success();
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
            ->label('save')
            ->submit('submit')
            ->keyBindings(['mod+s']);
    }
}
