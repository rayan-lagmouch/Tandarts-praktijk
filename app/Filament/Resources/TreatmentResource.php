<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentResource\Pages;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Healthcare Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->required(),
                Forms\Components\TextInput::make('treatment_type')
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'treated' => 'Treated',
                        'untreated' => 'Untreated',
                    ])
                    ->required(),
                Forms\Components\Checkbox::make('is_active')
                    ->default(true),
                Forms\Components\Textarea::make('note'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Use employee relationship properly
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Employee'),
                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Patient'),
                Tables\Columns\TextColumn::make('treatment_type'),
                Tables\Columns\TextColumn::make('date')
                    ->date(),
                Tables\Columns\TextColumn::make('time')
                    ->time(),
                Tables\Columns\TextColumn::make('cost')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . ' €'),
                // Using TextColumn with conditional badges
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'treated' => '<span class="badge bg-success">Treated</span>',
                        'untreated' => '<span class="badge bg-danger">Untreated</span>',
                        default => '',
                    })
                    ->html(), // Use HTML formatting to render badges
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('Active Only')
                    ->query(fn (Builder $query) => $query->where('is_active', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
