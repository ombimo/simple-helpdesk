<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no')
                    ->label('Ticket Number')
                    ->disabled(),

                Forms\Components\TextInput::make('title')
                    ->required(),

                Forms\Components\Select::make('requested_by')
                    ->label('Requested By')
                    ->relationship('requestedBy', 'name')
                    ->preload()
                    ->searchable(),

                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->tel(),

                Forms\Components\TextInput::make('email')
                    ->email(),

                Forms\Components\Select::make('departement_id')
                    ->label('Departement')
                    ->relationship('departement', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('location_id')
                    ->label('Location')
                    ->relationship('location', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('priority_id')
                    ->label('Priority')
                    ->relationship('priority', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('ticket_status_id')
                    ->label('Status')
                    ->relationship('ticketStatus', 'name')
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

                Forms\Components\FileUpload::make('proof_attachments')
                    ->multiple()
                    ->columnSpanFull()
                    ->previewable(true)
                    ->downloadable()
                    ->disk('local')
                    ->visibility('private')
                    ->openable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('no')
                    ->label('Ticket Number')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('requestedBy.name')
                    ->label('Requested By')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('departement.name'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category'),

                Tables\Columns\SelectColumn::make('priority_id')
                    ->label('Priority')
                    ->options(
                        Priority::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    ),

                Tables\Columns\SelectColumn::make('ticket_status_id')
                    ->label('Status')
                    ->options(
                        TicketStatus::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    ),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('requested_by')
                    ->label('Requested By')
                    ->relationship('requestedBy', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10),

                Tables\Filters\SelectFilter::make('departement_id')
                    ->label('Departement')
                    ->relationship('departement', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10),

                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10),

                Tables\Filters\SelectFilter::make('priority_id')
                    ->label('Priority')
                    ->relationship('priority', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10),

                Tables\Filters\SelectFilter::make('ticket_status_id')
                    ->label('Status')
                    ->relationship('ticketStatus', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10),
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
            'index'  => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit'   => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
