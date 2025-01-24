<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Mail\AppointmentCancelled;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Healthcare Management';

    protected static ?int $navigationSort = 3;

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Patient Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('employee.full_name')
                    ->label('Employee Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time')
                    ->label('Time')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('cancel')
                    ->label('Cancel Appointment')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Appointment $record) {
                        Log::info('Cancel appointment action triggered for ID: ' . $record->id);

                        // Update the appointment status to "cancelled"
                        $record->update(['status' => 'cancelled']);
                        Log::info('Appointment status updated to "cancelled" for ID: ' . $record->id);

                        try {
                            // Attempt to send email using AppointmentCancelled Mailable
                            Mail::to('john@gmail.com')->send(new AppointmentCancelled($record));
                            Log::info('AppointmentCancelled Mailable sent successfully for ID: ' . $record->id);
                        } catch (\Exception $e) {
                            Log::error('Failed to send AppointmentCancelled Mailable: ' . $e->getMessage());

                            // Fallback to raw email if Mailable fails
                            try {
                                Mail::raw(
                                    "The appointment for {$record->patient->full_name} on {$record->date} at {$record->time} has been cancelled.",
                                    function ($message) {
                                        $message->to('bob@gmail.com')->subject('Appointment Cancelled');
                                    }
                                );
                                Log::info('Fallback raw email sent successfully for ID: ' . $record->id);
                            } catch (\Exception $fallbackException) {
                                Log::error('Failed to send fallback raw email: ' . $fallbackException->getMessage());
                            }
                        }

                        // Send success notification
                        Notification::make()
                            ->title('Appointment Cancelled')
                            ->body('The appointment has been cancelled successfully.')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->options(Patient::all()->pluck('full_name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('employee_id')
                    ->label('Employee')
                    ->options(Employee::all()->pluck('full_name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->default(Carbon::now())
                    ->minDate(Carbon::today())
                    ->required(),

                Forms\Components\Select::make('time')
                    ->label('Time')
                    ->options([
                        '09:00' => '09:00',
                        '10:00' => '10:00',
                        '11:00' => '11:00',
                        '12:00' => '12:00',
                        '13:00' => '13:00',
                        '14:00' => '14:00',
                    ])
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
