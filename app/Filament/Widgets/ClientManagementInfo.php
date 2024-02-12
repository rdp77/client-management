<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ClientManagementInfo extends Widget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected static string $view = 'components.client-management-info';
}
