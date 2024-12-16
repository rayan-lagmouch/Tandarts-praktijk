<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('person_id')
                    ->relationship('person', 'first_name')
                    ->label('Person')
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->unique()
                    ->label('Patient Number'),
                Forms\Components\Textarea::make('medical_record')
                    ->label('Medical Record'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                Forms\Components\Textarea::make('note')
                    ->label('Notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('person.first_name')
                    ->label('First Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('person.last_name')
                    ->label('Last Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Patient Number')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->color('danger')
                    ->modalHeading('Delete patient')
                    ->modalDescription('Are you sure you\'d like to delete this patient? This cannot be undone.')
                    ->modalSubmitActionLabel('Yes, delete it'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Patient Information')
                    ->schema([
                        TextEntry::make('person.first_name')->label('First Name'),
                        TextEntry::make('person.last_name')->label('Last Name'),
                        TextEntry::make('number')->label('Patient Number'),
                        TextEntry::make('medical_record')->label('Medical Record'),
                        TextEntry::make('is_active')->label('Active Status'),
                        TextEntry::make('created_at')->label('Created At'),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}/view'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
