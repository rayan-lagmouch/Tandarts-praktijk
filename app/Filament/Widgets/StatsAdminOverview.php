<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    /**
     * Get the statistics for the widget.
     *
     * @return array
     */
    protected function getStats(): array
    {
        // Get the total number of users from the database
        $totalUsers = User::count();

        // Get the total number of employees with email ending with @smilepro.com
        $totalEmployees = Employee::whereHas('user', function ($query) {
            $query->where('email', 'like', '%@smilepro.com');
        })->count();

        // Placeholder for average time on page - this should be dynamic or fetched from analytics if needed
        $averageTimeOnPage = '3:12';

        // Default stats to show
        $stats = [
            // Stat for the total number of users
            Stat::make('Users', $totalUsers)
                ->description('All users from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // This chart is static. Replace with actual dynamic data if needed.
                ->color('success'),

            // Stat for average time on page (this is a placeholder and should be replaced by actual dynamic data)
            Stat::make('Average time on page', $averageTimeOnPage)
                ->description('3% increase') // This can be dynamically adjusted
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];

        // Check if there are no employees with @smilepro.com and add error stat
        if ($totalEmployees === 0) {
            $stats[] = Stat::make('Employees', 'Cannot load statistics')
                ->description('try again later')
                ->color('danger'); // Red color to show error state
        } else {
            // Stat for the total number of employees with email ending with @smilepro.com
            $stats[] = Stat::make('Employees', $totalEmployees)
                ->description('Employees registerd')
                ->descriptionIcon('heroicon-m-users')
                ->chart([10, 15, 20, 25, 30, 35, 40]) // Replace with actual dynamic data
                ->color('info');
        }

        return $stats;
    }
}
