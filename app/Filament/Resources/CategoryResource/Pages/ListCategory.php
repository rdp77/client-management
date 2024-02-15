<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ClientResource;
use App\Filament\Resources\ClientResource\Widgets;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategory extends ListRecords
{
    /**
     * The resource model.
     */
    protected static string $resource = CategoryResource::class;

    /**
     * The header actions.
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
