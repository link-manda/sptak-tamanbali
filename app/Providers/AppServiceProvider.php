<?php

namespace App\Providers;

use App\Models\AwigAwig;
use App\Models\Banjar;
use App\Models\GaleriDesa;
use App\Models\KategoriTransaksi;
use App\Models\Krama;
use App\Models\Pararem;
use App\Models\Prajuru;
use App\Models\ProfilDesa;
use App\Models\ProgramPrioritas;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\TimelineDesa;
use App\Models\Transaksi;
use App\Policies\AwigAwigPolicy;
use App\Policies\BanjarPolicy;
use App\Policies\GaleriDesaPolicy;
use App\Policies\KategoriTransaksiPolicy;
use App\Policies\KramaPolicy;
use App\Policies\PararemPolicy;
use App\Policies\PrajuruPolicy;
use App\Policies\ProfilDesaPolicy;
use App\Policies\ProgramPrioritasPolicy;
use App\Policies\SuratKeluarPolicy;
use App\Policies\SuratMasukPolicy;
use App\Policies\TimelineDesaPolicy;
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
        Gate::policy(SuratMasuk::class, SuratMasukPolicy::class);
        Gate::policy(SuratKeluar::class, SuratKeluarPolicy::class);
        Gate::policy(GaleriDesa::class, GaleriDesaPolicy::class);
        Gate::policy(ProgramPrioritas::class, ProgramPrioritasPolicy::class);
        Gate::policy(Prajuru::class, PrajuruPolicy::class);
        Gate::policy(ProfilDesa::class, ProfilDesaPolicy::class);
        Gate::policy(TimelineDesa::class, TimelineDesaPolicy::class);
        Gate::policy(AwigAwig::class, AwigAwigPolicy::class);
        Gate::policy(Pararem::class, PararemPolicy::class);
    }
}
