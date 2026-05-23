<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    // Mengatur interval polling otomatis ke server setiap 15 detik untuk memantau data real-time
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Koleksi oli & sparepart di database')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('info'),

            Stat::make('Produk Aktif', Product::where('is_active', true)->count())
                ->description('Produk tayang di katalog publik')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
