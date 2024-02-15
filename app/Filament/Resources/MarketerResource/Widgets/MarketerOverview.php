<?php

namespace App\Filament\Resources\MarketerResource\Widgets;

use App\Models\Client;
use App\Models\Marketer;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class MarketerOverview extends BaseWidget
{
    /**
     * The widget stats.
     */
    protected function getStats(): array
    {
        $marketers = Marketer::count();

        return [
            Stat::make('Total Marketers', Number::format($marketers))
                ->description('The total number of marketers')
                ->icon('heroicon-o-book-open'),
        ];
    }
}
