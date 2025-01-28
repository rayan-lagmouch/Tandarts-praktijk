<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NumberOfAppointments extends BaseWidget
{
    /**
     * Get the statistics for the widget.
     *
     * @return array
     */
    protected function getStats(): array
    {
        // Get the total number of appointments from the database
        $totalAppointments = Appointment::count();

        // Check if there are no appointments and show a message accordingly
        if ($totalAppointments === 0) {
            return [
                Stat::make('Total Appointments', 'No appointments booked')
                    ->description('try again later')
                    ->color('danger') // Red color to show error state
            ];
        }

        // Return the total number of appointments
        return [
            Stat::make('Total Appointments', $totalAppointments)
                ->description('Total planned Appointments')
                ->color('success') // Green color to show success state
        ];
    }
}
