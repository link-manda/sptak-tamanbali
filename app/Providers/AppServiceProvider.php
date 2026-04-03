<?php

namespace App\Providers;

use App\Models\Banjar;
use App\Models\KategoriTransaksi;
use App\Models\Krama;
use App\Models\Transaksi;
use App\Policies\BanjarPolicy;
use App\Policies\KategoriTransaksiPolicy;
use App\Policies\KramaPolicy;
use App\Policies\TransaksiPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Banjar::class, BanjarPolicy::class);
        Gate::policy(Krama::class, KramaPolicy::class);
        Gate::policy(KategoriTransaksi::class, KategoriTransaksiPolicy::class);
        Gate::policy(Transaksi::class, TransaksiPolicy::class);
    }
}
