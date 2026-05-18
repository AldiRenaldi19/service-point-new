<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Memaksa URL menggunakan HTTPS jika di lingkungan produksi
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Opsional: Jika nanti kamu ingin menambahkan CSS custom 
        // khusus untuk panel Filament tanpa mengganggu UI depan
    }
}
