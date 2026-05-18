<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class UserWelcome extends Widget
{
    protected static string $view = 'filament.widgets.user-welcome';

    // Biar muncul paling atas di panel User
    protected static ?int $sort = 1;

    // Biar lebarnya full 1 baris
    protected int | string | array $columnSpan = 'full';
}
