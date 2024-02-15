<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Filament\Resources\ClientResource\Widgets;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    /**
     * The resource model.
     */
    protected static string $resource = ClientResource::class;

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
            Widgets\ClientOverview::class,
        ];
    }
}
