<?php

namespace App\Filament\Widgets;

use App\Models\Scholarship;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Stats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total Data Beasiswa", Scholarship::count(). " beasiswa")
            ->chart([7, 2, 15, 3, 15, 4, 17])
            ->color('warning'),
            Stat::make("Total Daftar User", User::count(). " user")
            ->chart([1, 2, 5, 7, 10, 4, 17])
            ->color('info'),
            Stat::make('Beasiswa Ditutup', Scholarship::whereDate('close_date', '<', today())->count(). 
            " beasiswa")
            ->chart([2, 2, 4, 3, 10, 1, 1])
            ->color('danger'),
        ];
    }
}
