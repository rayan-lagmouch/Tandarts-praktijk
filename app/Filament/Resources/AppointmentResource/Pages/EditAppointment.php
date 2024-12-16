<?php
namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Carbon\Carbon;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $appointmentDate = $this->record->appointment_date;

        if (Carbon::parse($appointmentDate)->isTomorrow() || Carbon::parse($appointmentDate)->isToday()) {
            $this->notify('danger', 'Afspraak kan niet worden gewijzigd binnen één dag vóór de geplande datum.');
            $this->halt(); // Voorkomt het opslaan van wijzigingen
        }
    }
}
