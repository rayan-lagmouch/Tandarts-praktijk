<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->options(
                        Patient::query()
                            ->with('person') // Load the related person
                            ->get()
                            ->mapWithKeys(function ($patient) {
                                return [$patient->id => $patient->full_name];
                            })
                    )
                    ->searchable()
                    ->required()
                    ->preload(),

                Forms\Components\Select::make('treatment_id')
                    ->label('Treatment')
                    ->options(
                        Treatment::query()->pluck('treatment_type', 'id')->toArray()
                    )
                    ->searchable()
                    ->nullable(),

                Forms\Components\TextInput::make('number')
                    ->label('Invoice Number')
                    ->required()
                    ->maxLength(255)
                    ->unique('invoices', 'number', ignoreRecord: true),

                Forms\Components\DatePicker::make('date')
                    ->label('Invoice Date')
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                    ])
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true)
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Note')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Patient Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('number')
                    ->label('Invoice Number')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Invoice Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // You can add any filters here if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Custom PDF Action
                Tables\Actions\Action::make('pdf') // Custom Action to download PDF
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-o-document') 
                ->url(fn (Invoice $record) => route('invoices.pdf', $record->id)) // Use route for PDF download
                ->openUrlInNewTab(),                        
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            return $data;
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // MySQL Duplicate Entry Error Code
                Notification::make()
                    ->title('Error')
                    ->body('Invoice number already in use.')
                    ->danger()
                    ->send();

                throw ValidationException::withMessages([
                    'number' => 'Invoice number already in use.',
                ]);
            }

            throw $e;
        }
    }

    public static function getRelations(): array
    {
        return [
            // Add relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
