<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Carbon\Carbon;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Display full name of the patient and DOB from the `Person` model
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Patient Name')
                    ->getStateUsing(function (Appointment $record) {
                        $patient = $record->patient;
                        $dob = $patient ? $patient->person->date_of_birth : null;
                        $dobFormatted = $dob ? Carbon::parse($dob)->format('d-m-Y') : 'N/A';
                        return $patient ? $patient->full_name . ' (DOB: ' . $dobFormatted . ')' : '';
                    })
                    ->sortable()
                    ->searchable(),

                // Display full name of the employee and DOB from the `Person` model
                Tables\Columns\TextColumn::make('employee.full_name')
                    ->label('Employee Name')
                    ->getStateUsing(function (Appointment $record) {
                        $employee = $record->employee;
                        $dob = $employee ? $employee->person->date_of_birth : null;
                        $dobFormatted = $dob ? Carbon::parse($dob)->format('d-m-Y') : 'N/A';
                        return $employee ? $employee->full_name . ' (DOB: ' . $dobFormatted . ')' : '';
                    })
                    ->sortable()
                    ->searchable(),

                // Additional columns for Appointment details
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
            ->filters([])
            ->actions([]);
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Select a Patient from the list of available patients with DOB
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->options(
                        Patient::all()->mapWithKeys(function ($patient) {
                            $dob = $patient->person->date_of_birth ? Carbon::parse($patient->person->date_of_birth)->format('d-m-Y') : 'N/A';
                            return [
                                $patient->id => $patient->full_name . ' (DOB: ' . $dob . ')',
                            ];
                        })
                    )
                    ->searchable()
                    ->required(),

                // Select an Employee from the list of available employees with DOB
                Forms\Components\Select::make('employee_id')
                    ->label('Employee')
                    ->options(
                        Employee::all()->mapWithKeys(function ($employee) {
                            $dob = $employee->person->date_of_birth ? Carbon::parse($employee->person->date_of_birth)->format('d-m-Y') : 'N/A';
                            return [
                                $employee->id => $employee->full_name . ' (DOB: ' . $dob . ')',
                            ];
                        })
                    )
                    ->searchable()
                    ->required(),

                // Use a Date Picker for selecting a Date with a restriction on past dates
                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->default(Carbon::now()) // Defaults to today's date
                    ->minDate(Carbon::today()) // Prevents selecting past dates
                    ->required(),

                // Select a Time from a predefined list of times
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

                // Select a Status from a predefined list of statuses
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])  // Predefined list of statuses
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
