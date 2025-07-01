<?php

namespace App\Filament\Resources\Master;

use App\Filament\Resources\Master\TicketStatusResource\Pages;
use App\Models\TicketStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TicketStatusResource extends Resource
{
    protected static ?string $model = TicketStatus::class;

    protected static ?string $navigationGroup = 'Master';

    public static function getNavigationSort(): ?int
    {
        return config('navigation-sort.master.ticket-status');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),

                Forms\Components\TextInput::make('sort_order'),

                Forms\Components\Toggle::make('is_default')
                    ->label('Default Status'),

                Forms\Components\Toggle::make('is_show_widget')
                    ->label('Show in Widget'),

                Forms\Components\Toggle::make('is_show_tab')
                    ->label('Show in Tab'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_default')
                    ->label('Default')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_show_widget')
                    ->label('Show in Widget')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_show_tab')
                    ->label('Show in Tab')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTicketStatuses::route('/'),
            'create' => Pages\CreateTicketStatus::route('/create'),
            'edit'   => Pages\EditTicketStatus::route('/{record}/edit'),
        ];
    }
}
