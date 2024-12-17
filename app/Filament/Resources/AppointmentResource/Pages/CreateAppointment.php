<?php
namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use App\Models\Appointment;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Check if there is an existing appointment with the same date, time, and employee
        $existingAppointment = Appointment::where('date', $data['date'])
            ->where('time', $data['time'])
            ->where('employee_id', $data['employee_id'])
            ->first();

        if ($existingAppointment) {
            // Show a danger notification when there is a conflict
            Notification::make()
                ->title('Conflict')
                ->body('The selected employee is already booked at this date and time. Please choose a different employee or time.')
                ->danger()
                ->send();

            // Throw a validation exception to prevent appointment creation
            throw ValidationException::withMessages([
                'date' => ['The selected employee is already booked at this date and time.'],
            ]);
        }

        return $data;
    }
}
