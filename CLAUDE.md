# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

SPTAK Tamanbali — transparency portal for Desa Adat Tamanbali (Balinese customary village). Public informational site plus Filament admin panel for village finances, members, letters, governance, and customary-law content. UI text and code comments are Indonesian.

Stack: Laravel 13, PHP 8.3, Filament 5, Tailwind 4 + Vite, MySQL/MariaDB in dev/prod, SQLite `:memory:` in tests.

## Commands

```bash
composer dev          # server + queue listener + pail logs + vite concurrently
composer test         # config:clear, then php artisan test
composer setup        # composer install, .env copy, key:gen, migrate, npm install, build

php artisan test --filter=TestName     # single test
php artisan migrate:fresh --seed       # rebuild DB with seeders
./vendor/bin/pint                      # format PHP (Laravel Pint)
npm run build                          # production asset build
npm run dev                            # Vite only; use composer dev for full app
```

Seed data is wired through `database/seeders/DatabaseSeeder.php`: dummy village data, prajuru, profil desa, awig-awig, and pararem.

## Architecture

Two surfaces share the same Eloquent models:

1. **Public site** — `routes/web.php` → `PublicController` → `resources/views/public/*.blade.php`. Read-only pages: home, keuangan, surat, profil, prajuru, awig-awig, pararem. Every public page extends `resources/views/public/layout.blade.php`.

2. **Admin panel** — Filament at `/admin`, configured in `app/Providers/Filament/AdminPanelProvider.php`. Resources, pages, and widgets are auto-discovered from `app/Filament/`. Custom login/profile pages live in `app/Filament/Pages/Auth/`.

### Filament resource layout

Filament 5 resources are split by concern. For resource `Foo` under `app/Filament/Resources/Foos/`:

- `FooResource.php` — model, navigation, page wiring
- `Schemas/FooForm.php` — form fields (`configure(Schema $schema)`)
- `Tables/FoosTable.php` — table columns/actions (`configure(Table $table)`)
- `Pages/` — List/Create/Edit page classes

When adding admin fields or columns, edit `Schemas/` and `Tables/`, not only `*Resource.php`.

### Public content and PDFs

`PublicController` builds page view models directly from Eloquent queries. Finance pages use `Transaksi` totals, yearly filters, and catur-wulan grouping. Letter archives merge `SuratMasuk` and `SuratKeluar` collections before rendering.

PDF output uses `barryvdh/laravel-dompdf`: `/keuangan/laporan-realisasi` renders `resources/views/pdf/laporan-realisasi.blade.php`. Public document previews reuse `resources/views/public/partials/pdf-viewer.blade.php`.

### Frontend assets

Vite entrypoints are `resources/css/app.css` and `resources/js/app.js` (`vite.config.js`). Tailwind 4 is loaded through `@tailwindcss/vite`; `resources/css/app.css` defines Tailwind sources and theme values.

### Authorization

Role-based, not permission-based. `User::ROLES` defines roles; `User::PANEL_ROLES` gates Filament access via `canAccessPanel()`. Roles: `admin`, `staf_admin`, `staf_keuangan`, `petajuh`, `juru_raksa`, `masyarakat` (public-only). `role` is a plain string column (`2026_04_18_000001_change_role_column_in_users_table`).

Per-model access uses policies registered manually in `AppServiceProvider::boot()` via `Gate::policy()`. No policy auto-discovery here. Currently registered: `Banjar`, `Krama`, `KategoriTransaksi`, and `Transaksi`; register any new policy there or it will not run.

### Domain models

- `Transaksi` + `KategoriTransaksi` — finances (`jenis`: `pemasukan`/`pengeluaran`), finance widgets, public keuangan page, exports.
- `Krama` + `Banjar` — village members grouped by banjar.
- `Prajuru` — village officials, self-referential tree (`parent_id`/`children`), category/job options on the model.
- `SuratMasuk` / `SuratKeluar` — incoming/outgoing letters and public archive documents.
- `ProfilDesa`, `TimelineDesa`, `AwigAwig`, `Pararem` — profile/history/customary-law content.

Data export lives in `app/Filament/Exports/TransaksiExporter.php`. Dashboard widgets live in `app/Filament/Widgets/` and transaction resource widgets under `app/Filament/Resources/Transaksis/Widgets/`.

## Conventions

- Keep Indonesian model/table/resource names as-is (`Transaksis`, `Kramas`, `Panarems`); do not “correct” pluralization.
- Uploaded files use Filament `FileUpload` on the `public` disk; public URLs are generally built as `/storage/...`, so `php artisan storage:link` matters outside tests.
- Some image accessors fall back to `ui-avatars.com` placeholders.
- Queue/cache/session defaults come from `.env.example`: database queue/cache/session in local, sync/array in tests via `phpunit.xml`.
- README is still Laravel stock; prefer this file and code over README for project-specific guidance.
