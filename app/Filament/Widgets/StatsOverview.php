<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Koleksi oli & sparepart')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),

            Stat::make('Stok Menipis', Product::where('stock', '<', 5)->count())
                ->description('Perlu restock segera')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Produk Aktif', Product::where('is_active', true)->count())
                ->description('Tampil di landing page')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
    protected static ?string $pollingInterval = '15s';
}
