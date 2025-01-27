<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Apply logic to only show appointments for the authenticated user
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('patient', function (Builder $query) {
                $query->where('email', auth()->user()->email);
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Optionally define the form fields if needed, like appointment date, time, etc.
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Patient Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Appointment Date')
                    ->sortable(),
                // More columns can be added as needed, like status or notes
            ])
            ->filters([ /* Optional filters */ ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Only the view action will remain
            ])
            ->bulkActions([ /* Optional bulk actions */ ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'view' => Pages\ViewAppointment::route('/{record}/view'), // Add view page
        ];
    }
}
