<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvailabilityResource\Pages;
use App\Models\Availability;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AvailabilityResource extends Resource
{
    protected static ?string $model = Availability::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Healthcare Management';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('from_date')
                    ->required(),
                Forms\Components\DatePicker::make('to_date')
                    ->required(),
                Forms\Components\TimePicker::make('from_time')
                    ->required(),
                Forms\Components\TimePicker::make('to_time')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Present' => 'Present',
                        'Absent' => 'Absent',
                        'Leave' => 'Leave',
                        'Sick' => 'Sick',
                    ])
                    ->required(),
                Forms\Components\Checkbox::make('is_active')
                    ->default(true),
                Forms\Components\Textarea::make('note')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Employee')
                    ->sortable(),
                Tables\Columns\TextColumn::make('from_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('from_time')
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_time')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(fn ($state) => ucfirst($state)) // Capitalize the status name
                    ->color(function ($state) {
                        switch ($state) {
                            case 'Present':
                                return 'success';
                            case 'Absent':
                                return 'danger';
                            case 'Leave':
                                return 'warning';
                            case 'Sick':
                                return 'info';
                            default:
                                return 'secondary';
                        }
                    })
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Active')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('Active Only')
                    ->query(fn ($query) => $query->where('is_active', true)),
                Tables\Filters\Filter::make('Present Only')
                    ->query(fn ($query) => $query->where('status', 'Present')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAvailabilities::route('/'),
            'create' => Pages\CreateAvailability::route('/create'),
            'edit' => Pages\EditAvailability::route('/{record}/edit'),
        ];
    }
}
