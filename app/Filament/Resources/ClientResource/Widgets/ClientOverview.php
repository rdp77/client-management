<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use App\Models\Client;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class ClientOverview extends BaseWidget
{
    /**
     * The widget stats.
     */
    protected function getStats(): array
    {
        $clients = Client::count();
        $activeClients = Client::active()->count();
        $nonActiveClients = Client::nonActive()->count();

        return [
            Stat::make('Total Clients', Number::format($clients))
                ->description('The total number of clients')
                ->icon('heroicon-o-book-open'),

            Stat::make('Total Active Clients', Number::format($activeClients))
                ->description('The total number of active clients')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Total Non-Active Clients', Number::format($nonActiveClients))
                ->description('The total number of non-active clients')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
