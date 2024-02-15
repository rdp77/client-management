<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Client;
use App\Models\Post;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class ProductOverview extends BaseWidget
{
    /**
     * The widget stats.
     */
    protected function getStats(): array
    {
        $products = Product::count();

        return [
            Stat::make('Total Products', Number::format($products))
                ->description('The total number of products')
        ];
    }
}
