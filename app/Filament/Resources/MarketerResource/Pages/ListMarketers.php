<?php

namespace App\Filament\Resources\MarketerResource\Pages;

use App\Filament\Resources\MarketerResource\Widgets;
use App\Filament\Resources\MarketerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarketers extends ListRecords
{
    /**
     * The resource model.
     */
    protected static string $resource = MarketerResource::class;

    /**
     * The header actions.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * The header widgets.
     */
    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\MarketerOverview::class,
        ];
    }
}
