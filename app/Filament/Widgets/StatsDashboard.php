<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Foundation\Auth\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {

        $countCars = \App\Models\Car::count();
        $countReservations = \App\Models\Reservation::count();
        $countUsers = \App\Models\User::count();

        return [
            Stat::make('Cars Total', $countCars),
            Stat::make('Reservations Total', $countReservations),
            Stat::make('Users Total', $countUsers),
        ];
    }
}
