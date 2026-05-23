<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\Widget;

class UserWelcome extends Widget
{
    // Memastikan path view presisi menggunakan notasi titik (dot notation)
    protected static string $view = 'filament.app.widgets.user-welcome';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';
}
