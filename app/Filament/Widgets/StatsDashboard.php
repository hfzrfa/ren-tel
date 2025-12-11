<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends StatsOverviewWidget
{
    // Auto-refresh this widget without reloading the page
    protected function getPollingInterval(): ?string
    {
        return '5s';
    }

    protected function getStats(): array
    {

    $countCars = Car::count();
    $countReservations = Reservation::count();
    $countUsers = User::count();

        return [
            Stat::make('Cars Total', $countCars),
            Stat::make('Reservations Total', $countReservations),
            Stat::make('Users Total', $countUsers),
        ];
    }
}
