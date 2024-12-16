<?php
namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Resources\Pages\EditRecord;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $appointmentDate = Carbon::parse($data['date']);
        $now = Carbon::now();

        // Check if the appointment date is today or in the past
        if ($appointmentDate->isToday() || $appointmentDate->isPast()) {
            // Show an error notification
            Notification::make()
                ->title('Error')
                ->body('You can\'t change the appointment one day before or on the same day.')
                ->danger()
                ->send();

            // Throw a validation exception with a custom error message
            throw ValidationException::withMessages([
                'date' => ['You can\'t change the appointment one day before or on the same day.'],
            ]);
        }

        return $data;
    }
}
